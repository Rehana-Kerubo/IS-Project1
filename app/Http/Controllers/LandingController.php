<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function landing()
{
    $announcement = Announcement::where('start_date', '>', Carbon::now())
                        ->orderBy('start_date', 'asc')
                        ->first();

    return view('landing', compact('announcement'));
}
}
