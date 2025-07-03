<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Get user from Google
        $googleUser = Socialite::driver('google')->user();

        // Check if the user already exists
        $existingBuyer = Buyer::where('email', $googleUser->getEmail())->first();

        // Update or create the user
        $buyer = Buyer::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'full_name' => $googleUser->getName(),
                'profile_pic' => $googleUser->getAvatar(),
                'role' => $existingBuyer->role ?? 'buyer',
            ]
        );

        // Log them in
        Auth::guard('buyer')->login($buyer);

        // Route based on role
        if ($buyer->role === 'vendor') {
            return redirect('/vendor/dashboard')->with('success', 'Welcome back, Vendor!');
        }

        //Ask for phone number if missing
        if (is_null($buyer->phone_number)) {
            return redirect('/buyer/edit')->with('info', 'Please update your phone number to continue.');
        }

        return redirect('/buyer/landing')->with('success', 'Logged in successfully!');
    }
}
