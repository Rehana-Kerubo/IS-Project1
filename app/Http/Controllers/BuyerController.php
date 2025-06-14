<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function updateProfile(Request $request)
    {
        $buyer = Auth::user(); // This assumes you're using the default guard

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

        $buyer->full_name = $request->input('full_name');
        $buyer->phone_number = $request->input('phone_number');

        if ($request->hasFile('profile_pic')) {
            $imagePath = $request->file('profile_pic')->store('profiles', 'public');
            $buyer->profile_pic = $imagePath;
        }

        $buyer->save();

        return redirect('/buyer/view-acc')->with('success', 'Profile updated successfully!');
    }
}
