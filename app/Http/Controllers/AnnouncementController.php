<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

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


    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'venue' => 'required|string|max:100',
            'time' => 'required|string|max:100',
            'end_time' => 'required|string|max:100',
        ]);

        Announcement::create($request->all());

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement posted successfully!');
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
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement updated successfully!');
    }



}
