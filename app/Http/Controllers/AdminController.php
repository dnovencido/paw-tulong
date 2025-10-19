<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ChatLog;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class);
    }

    // ✅ Admin Home (Dashboard)
    public function index()
    {
        $user = Auth::user();

        // Total users and total chats
        $totalUsers = User::count();
        $totalChats = ChatLog::count();

        // Most asked questions
        $mostAsked = ChatLog::select('question', DB::raw('COUNT(*) as count'))
            ->groupBy('question')
            ->orderByDesc('count')
            ->limit(20)
            ->get();

        // Top users
        $topUsers = ChatLog::select('user_id', DB::raw('COUNT(*) as conversations_count'))
            ->with('user')
            ->groupBy('user_id')
            ->orderByDesc('conversations_count')
            ->limit(20)
            ->get();

        return view('admin.dashboard', compact(
            'user',
            'totalUsers',
            'totalChats',
            'mostAsked',
            'topUsers'
        ));
    }

    
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $user->update(['username' => $request->username]);

        return back()->with('success', 'Profile updated successfully!');
    }

    
    public function changePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'message' => 'Current password is incorrect.'
        ], 422);
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return response()->json([
        'message' => 'Password changed successfully!'
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }

  
    public function export(Request $request)
    {
        $type = $request->get('type');

        if ($type === 'top_questions') {
            $data = ChatLog::select('question', DB::raw('COUNT(*) as count'))
                ->groupBy('question')->orderByDesc('count')->get();
            $filename = 'top_questions.csv';
            $headers = ['Question', 'Count'];
        } elseif ($type === 'top_users') {
            $data = ChatLog::select('user_id', DB::raw('COUNT(*) as conversations_count'))
                ->with('user')->groupBy('user_id')->orderByDesc('conversations_count')->get();
            $filename = 'top_users.csv';
            $headers = ['User', 'Conversations'];
        } else {
            return back()->with('error', 'Invalid export type.');
        }

        $callback = function() use ($data, $headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            foreach ($data as $row) {
                if (isset($row->user)) {
                    fputcsv($file, [$row->user->username ?? 'Unknown', $row->conversations_count]);
                } else {
                    fputcsv($file, [$row->question, $row->count]);
                }
            }

            fclose($file);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]);
    }
}
