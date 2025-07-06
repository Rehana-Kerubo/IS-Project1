<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\AnnouncementImage;

class SchedulesController extends Controller
{
    public function index()
    {
        $now = now();

        $upcomingAnnouncements = Announcement::where('start_date', '>', $now)->orderBy('start_date')->get();
        $previousAnnouncements = Announcement::where('end_date', '<', $now)->orderByDesc('start_date')->get();

        return view('schedules', [
            'upcomingAnnouncements' => $upcomingAnnouncements,
            'previousAnnouncements' => $previousAnnouncements
        ]);
    }
    public function show($announcement_id)
    {
        $announcement = Announcement::findOrFail($announcement_id);

        // Get only the images that belong to this specific announcement
        $images = AnnouncementImage::where('announcement_id', $announcement_id)->get();

        return view('show-schedules', compact('announcement', 'images'));
    }
}
