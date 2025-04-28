<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->has('email') && $request->has('password')) {
            $admin = Admin::where('email', $request->email)->first();

            if ($admin) {
                if (Hash::check($request->password, $admin->password)) {
                    Auth::login($admin);
                    return redirect()->route('admin.dashboard');
                } else {
                    return back()->withErrors(['email' => 'Invalid credentials']);
                }
            } else {
                if (Auth::attempt(['email' => $request->only('email', 'password')])) {
                    return redirect('/home');  // Normal user home
                } else {
                    return back()->withErrors(['email' => 'Invalid credentials']);
                }
            }
        }

        return redirect()->route('google.login');
    }
}
