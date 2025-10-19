<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\ChatLog;
use App\Models\ChatSession;
use App\Services\DialogflowService;

class ChatbotController extends Controller
{
    protected $dialogflow;

    public function __construct(DialogflowService $dialogflow)
    {
        $this->dialogflow = $dialogflow;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userId = Auth::id();

        if ($request->has('new')) {
            $currentSession = ChatSession::create([
                'user_id' => $userId,
                'session_name' => 'Session ' . now()->format('M d, Y H:i')
            ]);
        } else {
            $currentSession = ChatSession::where('user_id', $userId)
                ->latest('updated_at')
                ->first();

            if (!$currentSession) {
                $currentSession = ChatSession::create([
                    'user_id' => $userId,
                    'session_name' => 'Session ' . now()->format('M d, Y H:i')
                ]);
            }
        }

        $sessions = ChatSession::where('user_id', $userId)
            ->with(['chatLogs' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($session) {
                $latestLog = $session->chatLogs->first();
                $session->preview = $latestLog ? substr($latestLog->question, 0, 50) . '...' : 'No messages yet';
                $session->last_updated = $latestLog
                    ? $latestLog->created_at->format('M d, Y H:i')
                    : $session->created_at->format('M d, Y H:i');
                return $session;
            });

        $conversation = $currentSession->chatLogs()->orderBy('created_at')->get();

        return view('chat.index', compact('sessions', 'conversation', 'currentSession'));
    }

    public function newSession(Request $request)
    {
        $userId = Auth::id();

        $session = ChatSession::create([
            'user_id' => $userId,
            'session_name' => 'Session ' . now()->format('M d, Y H:i')
        ]);

        Log::info('New chat session created', [
            'session_id' => $session->id,
            'user_id' => $userId
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $session->id,
            'session_name' => $session->session_name
        ]);
    }

    public function send(Request $request)
    {
        Log::info('Chatbot send() triggered', $request->all());

        $start = microtime(true);
        $userId = Auth::id();
        $message = trim($request->input('message'));
        $sessionId = $request->input('session_id');

        if (!$message) {
            return response()->json(['reply' => '⚠️ Please type a message.']);
        }

        $session = ChatSession::where('id', $sessionId)
            ->where('user_id', $userId)
            ->first();

        if (!$session) {
            $session = ChatSession::create([
                'user_id' => $userId,
                'session_name' => 'Session ' . now()->format('M d, Y H:i')
            ]);
        }

        $reply = "Sorry, I didn’t understand that.";
        $category = 'General';

        try {
            $result = $this->dialogflow->detectIntent($session->id, $message);
            if ($result && isset($result->fulfillmentText)) {
                $reply = $result->fulfillmentText;
            }
            if ($result && isset($result->intentDisplayName)) {
                $category = $result->intentDisplayName;
            }
        } catch (\Exception $e) {
            Log::error('Dialogflow error', ['error' => $e->getMessage()]);
            $reply = "⚠️ Error communicating with Dialogflow. Try again later.";
        }

        $responseTime = microtime(true) - $start;

        try {
            $isFirstMessage = !ChatLog::where('chat_session_id', $session->id)->exists();
            if ($isFirstMessage) {
                $session->session_name = Str::limit($message, 50, '');
                $session->save();
            }

            ChatLog::create([
                'user_id' => $userId,
                'chat_session_id' => $session->id,
                'question' => $message,
                'answer' => $reply,
                'category' => $category,
                'response_time' => $responseTime,
            ]);

            $session->touch();
        } catch (\Exception $e) {
            Log::error('Chat log save failed', ['error' => $e->getMessage()]);
        }

        return response()->json([
            'reply' => $reply,
            'session_id' => $session->id,
            'time' => round($responseTime, 2),
        ]);
    }

    public function showConversation($id)
    {
        $userId = Auth::id();

        $currentSession = ChatSession::where('id', $id)
            ->where('user_id', $userId)
            ->with('chatLogs')
            ->first();

        if (!$currentSession) {
            $newSession = ChatSession::create([
                'user_id' => $userId,
                'session_name' => 'Session ' . now()->format('M d, Y H:i')
            ]);
            return redirect()->route('chatbot.show', ['id' => $newSession->id]);
        }

        $sessions = ChatSession::where('user_id', $userId)
            ->with(['chatLogs' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($session) {
                $latestLog = $session->chatLogs->first();
                $session->preview = $latestLog ? substr($latestLog->question, 0, 50) . '...' : 'No messages yet';
                $session->last_updated = $latestLog
                    ? $latestLog->created_at->format('M d, Y H:i')
                    : $session->created_at->format('M d, Y H:i');
                return $session;
            });

        $conversation = $currentSession->chatLogs()->orderBy('created_at')->get();

        return view('chat.index', compact('sessions', 'conversation', 'currentSession'));
    }

    public function deleteSession($id)
    {
        $userId = Auth::id();

        $session = ChatSession::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        ChatLog::where('chat_session_id', $session->id)->delete();
        $session->delete();

        Log::info('Chat session deleted', [
            'session_id' => $id,
            'user_id' => $userId
        ]);

        return response()->json(['success' => true]);
    }

    public function rename(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        $session = ChatSession::where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$session) {
            return response()->json(['success' => false, 'message' => 'Session not found'], 404);
        }

        $session->session_name = $request->name;
        $session->save();

        return response()->json(['success' => true, 'session_name' => $session->session_name]);
    }
}
