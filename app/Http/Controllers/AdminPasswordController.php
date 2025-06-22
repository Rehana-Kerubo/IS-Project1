<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminPasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = auth('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->must_change_password = false; // ✅ Mark as no longer required to change
        $admin->save();

        return redirect('/admin/profile')->with('success', 'Password changed successfully!');
    }
}
