<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class SchedulesController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('start_date', 'asc')->get();
        return view('schedules', compact('announcements'));
    }
}
