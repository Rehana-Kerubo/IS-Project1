<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index() {
        $announcements = Announcement::orderBy('start_date', 'desc')->get();
        return view('admin.announcements', compact('announcements'));
    }

    public function create()
    {
        return view('admin.create-announcements');
    }


    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:100',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'venue' => 'required|string|max:100',
        'time' => 'required|string|max:100',
        'end_time' => 'required|string|max:100',
        'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // validate multiple
    ]);

    $announcement = Announcement::create([
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'venue' => $request->venue,
        'time' => $request->time,
        'end_time' => $request->end_time,
    ]);

    // Handle multiple image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('announcements', 'public');

            AnnouncementImage::create([
                'announcement_id' => $announcement->announcement_id,
                'image_url' => $path,
            ]);
        }
    }

    return redirect()->route('admin.announcements.index')
        ->with('status', 'Announcement posted with images!');
}

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement deleted successfully!');
    }
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.edit-announcements', compact('announcement'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:100',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'venue' => 'required|string|max:100',
        'time' => 'required|string|max:100',
        'end_time' => 'required|string|max:100',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $announcement = Announcement::findOrFail($id);

    // Save new images 
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('announcements', 'public');

            AnnouncementImage::create([
                'announcement_id' => $announcement->announcement_id,
                'image_url' => $path,
            ]);
        }
    }

    // Update announcement fields
    $announcement->update([
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'venue' => $request->venue,
        'time' => $request->time,
        'end_time' => $request->end_time,
    ]);

    return redirect()->route('admin.announcements.index')
        ->with('status', 'Announcement updated successfully!');
}


}
