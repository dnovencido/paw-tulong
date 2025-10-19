<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientLandingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $mostAsked = []; 
        $recentConversations = []; 

        return view('client.landing', compact('user', 'mostAsked', 'recentConversations'));
    }
}
