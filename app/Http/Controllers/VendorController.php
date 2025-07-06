<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Category;


class VendorController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        // Show the vendor registration form
        return view('/buyer/be-vendor', compact('categories'));
    }

//     public function search(Request $request)
// {
//     $query = strtolower($request->input('query'));
//     // Filter based on search query
//     $results = Product:: when($query, function ($q) use ($query) {
//         $q->where ('name', 'like', '%' . $query . '%')
//             ->orWhere('description', 'like', '%' . $query . '%');
//     })->get();

//     return view('vendor.search', ['results' => $results]);
// }

public function store(Request $request)
{
    $request->validate([
        'shop_name' => 'required|string|max:100',
        'category_id' => 'required|exists:categories,id',
    ]);

    $user = Auth::guard('buyer')->user();
    $user->role = 'vendor';
    $user->save();

    // Check if the buyer is already registered as a vendor
    if (Vendor::where('buyer_id', $user->buyer_id)->exists()) {
        return redirect()->back()->with('error', 'You have already registered as a vendor.');
    }

    Vendor::create([
        'buyer_id' => $user->buyer_id,
        'shop_name' => $request->shop_name,
        'category_id' => $request->category_id,
        // status defaults to 'unverified'
    ]);

    return redirect('/vendor/dashboard')->with('success', 'Successfully registered as vendor!');
}

    //Update vendor details
    public function update(Request $request)
{
    $request->validate([
        'shop_name' => 'required|string|max:100',
        'category_id' => 'required|exists:categories,id',
    ]);

    $user = Auth::guard('buyer')->user();
    $user->role = 'vendor';
    $user->save();

    $vendor = $user->vendor;

    if (!$vendor) {
        return redirect()->back()->with('error', 'You are not registered as a vendor.');
    }

    $vendor->shop_name = $request->shop_name;
    $vendor->category_id = $request->category_id;
    $vendor->save();

    return redirect()->back()->with('success', 'Shop details updated successfully!');
}


    public function landing()
    {
        $announcement = Announcement::where('start_date', '>', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->first();

        $products = Product::all(); // so the products also load

        return view('vendor.v-landing', compact('announcement', 'products'));
    }

    public function checkout(Request $request)
    {
        $product =  Product::findOrFail($request->input('product_id'));
        $buyer = Auth::guard('buyer')->user();
        return view('vendor.checkout', compact('product', 'buyer'));
    }

    public function paymentLoader(Request $request)
    {
        $product = Product::findOrFail($request->product_id); // ✅ will now work
        $quantity = $request->input('quantity', 1); // Default to 1 if not provided
        $total = $product->price * $quantity;
        // Store the checkout data in the session
        session([
            'product_name' => $product->name,
            'quantity' => $quantity,
            'total' => $total, // Or your own logic
            'pickup_date' => now()->addDays(2)->toDateString(),
        ]);
        // Simulate a small delay before redirecting to the success page
        return view('vendor.payment-loader');
    }

    public function paymentSuccess()
    {
        return view('vendor.payment-success');
    }
    public function updateProfile(Request $request)
    {
        $buyer = Auth::guard('buyer')->user(); // This assumes you're using the default guard

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

        $buyer->full_name = $request->input('full_name');
        $buyer->phone_number = $request->input('phone_number');

        // if ($request->hasFile('profile_pic')) {
        //     $imagePath = $request->file('profile_pic')->store('profiles', 'public');
        //     $buyer->profile_pic = $imagePath;
        // }

        $buyer->save();

        return redirect('/vendor/profile')->with('success', 'Profile updated successfully!');
    }
    public function schedules()
    {
        $now = now();

        $upcomingAnnouncements = Announcement::where('start_date', '>', $now)->orderBy('start_date')->get();
        $previousAnnouncements = Announcement::where('end_date', '<', $now)->orderByDesc('start_date')->get();

        return view('/vendor/schedules', [
            'upcomingAnnouncements' => $upcomingAnnouncements,
            'previousAnnouncements' => $previousAnnouncements
        ]);
    }
    public function show($announcement_id)
    {
        $announcement = Announcement::findOrFail($announcement_id);

        // Get only the images that belong to this specific announcement
        $images = AnnouncementImage::where('announcement_id', $announcement_id)->get();

        return view('/vendor/show-schedules', compact('announcement', 'images'));
    }
    
}

