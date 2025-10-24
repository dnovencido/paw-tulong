<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();

        $recentConversations = ChatLog::where('user_id', $user->id)
            ->latest()
            ->take(20)
            ->get();

        $mostAsked = ChatLog::select('question', DB::raw('COUNT(*) as count'))
            ->groupBy('question')
            ->orderByDesc('count')
            ->pluck('question');

        return view('client.dashboard', compact('user', 'mostAsked', 'recentConversations'));
    }

    
    public function landing()
{
    $user = Auth::user();

    // Total chat count
    $totalChats = ChatLog::where('user_id', $user->id)->count();

    // Most asked questions (top 10 unique)
    $mostAsked = ChatLog::where('user_id', $user->id)
        ->whereNotNull('question')
        ->where('question', '!=', '')
        ->select('question', DB::raw('COUNT(*) as count'))
        ->groupBy('question')
        ->orderByDesc('count')
        ->limit(10)
        ->pluck('question');

    // Recent conversations — strictly last 10 valid chats
    $recentConversations = ChatLog::where('user_id', $user->id)
        ->whereNotNull('question')
        ->where('question', '!=', '')
        ->orderByDesc('created_at')
        ->take(10)
        ->get();

    return view('client.landing', compact('user', 'mostAsked', 'recentConversations', 'totalChats'));
}


    
    public function show()
    {
        $user = Auth::user();
        return view('client.profile', compact('user'));
    }

    
    public function edit()
    {
        $user = auth()->user();
        return view('client.edit-profile', compact('user'));
    }

    
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only('username', 'email');

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '_' . $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->move(public_path('img/profile'), $imageName);
            $data['profile_image'] = 'img/profile/' . $imageName;
        }

        $user->update($data);

        return redirect()->route('client.profile')->with('success', 'Profile updated successfully!');
    }

    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password changed successfully!');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
    public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'username' => 'required|string|max:255',
    ]);

    $user->username = $request->username;
    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}

}
