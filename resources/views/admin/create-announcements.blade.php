@extends('admin.sidebar')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Post New Announcement</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please correct the following:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.announcements.store') }}" method="POST" class="p-4 bg-white shadow rounded" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" maxlength="100" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Venue <span class="text-danger">*</span></label>
            <input type="text" name="venue" id="venue" maxlength="100" class="form-control" required value="{{ old('venue') }}">
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Start Time <span class="text-danger">*</span></label>
            <input type="time" name="time" id="time" maxlength="100" class="form-control" required value="{{ old('time') }}">
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
            <input type="time" name="end_time" id="end_time" maxlength="100" class="form-control" required value="{{ old('end_time') }}">
        </div>

        @php
            $today = date('Y-m-d');
        @endphp
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" id="start_date" class="form-control" required min="{{ $today }}" required value="{{ old('start_date') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                <input type="date" name="end_date" id="end_date" class="form-control" required min="{{ $today }}" required value="{{ old('end_date') }}">
            </div>
        </div>
        <div class="mb-3">
    <label for="images">Upload Event Venue</label>
    <input type="file" id="image-input" name="images[]" multiple class="form-control">
</div>

<!-- Image Previews Will Go Here -->
<div id="image-preview" class="d-flex flex-wrap gap-3 mt-3"></div>


        
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary px-4">Post Announcement</button>
        </div>
    </form>
</div>
<script>
    document.getElementById('image-input').addEventListener('change', function (e) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = ''; // Clear previous previews

        const files = e.target.files;

        if (files.length === 0) return;

        Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxHeight = '150px';
                img.style.marginRight = '10px';
                img.classList.add('rounded', 'shadow-sm');
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

@endsection
