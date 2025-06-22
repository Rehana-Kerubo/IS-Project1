@extends('admin.sidebar')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Announcement</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Please fix the following:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.announcements.update', $announcement->announcement_id) }}" method="POST" class="p-4 bg-white shadow rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" maxlength="100" class="form-control" required value="{{ old('title', $announcement->title) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $announcement->description) }}</textarea>
        </div>

        @php
            $today = date('Y-m-d');
        @endphp

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    required min="{{ $today }}" value="{{ old('start_date', $announcement->start_date) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                <input type="date" name="end_date" id="end_date" class="form-control"
                    required min="{{ $today }}" value="{{ old('end_date', $announcement->end_date) }}">
            </div>
        </div>


        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary px-4">Update</button>
        </div>
    </form>
</div>
@endsection
