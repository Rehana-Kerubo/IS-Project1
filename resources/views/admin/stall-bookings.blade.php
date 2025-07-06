@extends('admin.sidebar')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Flea Market Events</h2>
    <h4 class="mb-4">Grand Total: KSh {{ number_format($upcomingEvents->sum('stall_payments_sum_amount_paid') + 
        $previousEvents->sum('stall_payments_sum_amount_paid')) }}</h4>

        <div class="card mb-5 shadow-sm">
  <div class="card-body">
    <h5 class="card-title">Event Earnings Comparison</h5>
    <canvas id="earningsChart" height="120"></canvas>
  </div>
</div>


    {{-- UPCOMING EVENTS --}}
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 style="color:#0707a0;">Upcoming Events</h4>
        </div>

        @if ($upcomingEvents->isEmpty())
            <p class="text-muted">No upcoming flea markets.</p>
        @else
            <div class="row">
                @foreach($upcomingEvents as $event)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">{{ $event->title }}</h4>
                            <p class="card-text">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</p>
                            <p class="card-text">{{ $event->stall_count }} Stall{{ $event->stall_count !== 1 ? 's' : '' }}</p>
                            <p class="card-text text-success font-weight-bold"><strong>Total Made:<br>KSh {{ number_format($event->stall_payments_sum_amount_paid) }}</strong></p>
                            <a href="{{ route('admin.show-stall-bookings.show', $event->announcement_id) }}" class="btn btn-sm btn-primary mt-3">View Stall Bookings</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- PREVIOUS EVENTS --}}
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 style="color: #888;">Previous Events</h4>
        </div>

        @if ($previousEvents->isEmpty())
            <p class="text-muted">No previous flea markets.</p>
        @else
            <div class="row">
                @foreach($previousEvents as $event)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">{{ $event->title }}</h4>
                            <p class="card-text">{{ \Carbon\Carbon::parse($event->start_date)->format('d F') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d F') }}</p>
                            <p class="card-text">{{ $event->stall_count }} Stall{{ $event->stall_count !== 1 ? 's' : '' }}</p>
                            <p class="card-text text-success font-weight-bold"><strong>Total Made:<br>KSh {{ number_format($event->stall_payments_sum_amount_paid) }}</strong></p>
                            <a href="{{ route('admin.show-stall-bookings.show', $event->announcement_id) }}" class="btn btn-sm btn-primary mt-3">View Stall Bookings</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('earningsChart').getContext('2d');

  const earningsChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($upcomingTitles->merge($previousTitles)),
      datasets: [
        {
          label: 'Upcoming Events',
          backgroundColor: '#28a745',
          data: @json($upcomingTotals),
        },
        {
          label: 'Previous Events',
          backgroundColor: '#007bff',
          data: @json($previousTotals),
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'top' },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'KSh ' + value.toLocaleString();
            }
          }
        }
      }
    }
  });
</script>

@endsection
