<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $admin = Auth::guard('admin')->user();

        if ($admin->must_change_password) {
            return redirect()->route('admin.password.change');
        }

        return redirect()->intended('/admin/profile');
    }

    // Handle failed login
    if (!Admin::where('email', $request->email)->exists()) {
        return back()->withErrors(['email' => 'Invalid Email.']);
    }

    return back()->withErrors(['password' => 'Incorrect Password.']);
}

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
