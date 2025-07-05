@extends('admin.sidebar')

@section('content')
<div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-4">Announcements</h1>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">New Announcement</a>
    </div>

    @if ($announcements->isEmpty())
        <div class="alert alert-info">No announcements have been posted yet.</div>
    @else
    </div>
        <div class="card shadow">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            
                            <th>Title</th>
                            <th>Dates</th>
                            <th>Venue</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr>
                                
                                <td>{{ $announcement->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($announcement->start_date)->format('d F') }} - 
                                    {{ \Carbon\Carbon::parse($announcement->end_date)->format('d F') }}</td>
                                <td>{{ $announcement->venue }}</td>
                                <td>{{ $announcement->time }} - {{ $announcement->end_time }}</td>
                                
                                <td>
                                    <a href="{{ route('admin.announcements.edit', $announcement->announcement_id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('admin.announcements.destroy', $announcement->announcement_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this announcement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
