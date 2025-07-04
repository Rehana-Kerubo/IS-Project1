<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use App\Models\User;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;

class ManualAuthController extends Controller
{
    public function register(Request $request)
    {
        session(['form_type' => 'register']);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:buyers,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $buyer = Buyer::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => null, // Optional field
            'profile_pic' => null, // Optional field
        ]);

        // Buyer::create(['user_id' => $user->id]);

        Auth::guard('buyer')->login($buyer);

        return redirect('/buyer/landing')->with('success', 'Registration successful! Welcome to the platform.');
    }

    public function login(Request $request)
    {
        session(['form_type' => 'login']);

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $buyer = Buyer::where('email', $request->email)->first();

        if (!$buyer || !Hash::check($request->password, $buyer->password)) {
            return redirect()->back()->withErrors(['email' => 'The provided email is not registered.'], 'login');
        }


        // 
        Auth::guard('buyer')->login($buyer);

        return redirect('/buyer/landing')->with('success', 'Login successful! Welcome back.');}
}
