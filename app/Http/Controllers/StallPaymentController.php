<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StallPayment;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;


class StallPaymentController extends Controller
{
    public function index()
    {
        $events = Announcement::whereDate('end_date', '>=', now())->get();
        return view('vendor.select-event', compact('events'));
    }

    public function create($announcement_id)
    {
        $event = Announcement::findOrFail($announcement_id);
        $vendor = Auth::guard('buyer')->user()->vendor;

        return view('vendor.book-stall', compact('event', 'vendor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,vendor_id',
            'announcement_id' => 'required|exists:announcements,announcement_id',
            'amount_paid' => 'required|numeric|min:600',
        ]);

        StallPayment::create([
            'vendor_id' => $request->vendor_id,
            'announcement_id' => $request->announcement_id,
            'amount_paid' => $request->amount_paid,
            'status' => 'paid',
        ]);

        return redirect('/vendor/book-stall')->with('success', 'Stall booked successfully!');
    }
}