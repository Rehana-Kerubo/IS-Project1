@extends('admin.sidebar')

@section('content')
<div class="container mt-4">
    
        
        <h2 class="mb-4">Flea Market Events</h2>
        <h4 class="mb-4" style="color:rgb(52, 7, 215); font-weight: bold;">Grand Total: KSh {{ number_format($events->sum('stall_payments_sum_amount_paid')) }}</h4>
        
        <div class="card-body">
            @if ($events->isEmpty())
                <p class="text-muted">No flea market events available at the moment.</p>
            @else
                <div class="row">
                    @foreach($events as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $event->title }}</h4>
                                    <p class="card-text" style="color: #000000;">
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                    </p>
                                    <p class="card-text mb-4" style="color: #000000;">
                                        {{ $event->stall_count }} Stall{{ $event->stall_count !== 1 ? 's' : '' }}
                                    </p>
                                    <p class="card-text" style="color:rgb(4, 180, 57); font-weight: bold;">Total Made: <br> KSh {{ number_format($event->stall_payments_sum_amount_paid) }}</p>
                                    <a href="{{ route('admin.show-stall-bookings.show', $event->announcement_id) }}"
                                    class="btn btn-sm btn-primary mt-3">
                                        View Stall Bookings
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    
</div>
@endsection
