@extends('vendor.sidebar')

@section('content')
    <h2>Select Flea Market Event</h2>

    <ul class="list-group">
        @foreach($events as $event)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $event->title }}</strong><br>
                    {{ $event->start_date }} to {{ $event->end_date }}<br>
                    {{ $event->description }}
                </span>
                <a href="{{ route('stall.create', $event->announcement_id) }}" class="btn btn-primary">Book Stall</a>
            </li>
        @endforeach
    </ul>
@endsection
