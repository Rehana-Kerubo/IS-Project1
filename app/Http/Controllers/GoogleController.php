<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $googleUser = Socialite::driver('google')->user();

        $buyer = Buyer::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'full_name' => $googleUser->getName(),
            'profile_pic' => $googleUser->getAvatar(),
            'role' => $buyer->role ?? 'buyer',
        ]);

        Auth::guard('buyer')->login($buyer);

        // Redirect based on role
        if ($buyer->role === 'vendor') {
            return redirect('/vendor/dashboard')->with('success', 'Welcome back, Vendor!');
        }

        return redirect('/buyer/landing')->with('success', 'Logged in successfully!');
    }

}
