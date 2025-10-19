<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatLog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        
        if ($user->user_type === 'admin') {
            $logs = ChatLog::latest()->take(10)->get();
            $topUsers = ChatLog::selectRaw('user_id, COUNT(*) as total')
                ->groupBy('user_id')
                ->orderByDesc('total')
                ->take(5)
                ->get();

            return view('admin.dashboard', compact('user', 'logs', 'topUsers'));
        }

        
        if ($user->user_type === 'client' || $user->user_type === 'user') {
            $mostAsked = ChatLog::select('question')
                ->groupBy('question')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(5)
                ->pluck('question');

            $recentConversations = ChatLog::where('user_id', $user->id)
                ->latest()
                ->take(10)
                ->get();

            return view('client.dashboard', compact('user', 'mostAsked', 'recentConversations'));
        }

        
        return redirect()->route('login.form')->with('error', 'Unauthorized access.');
    }
}
