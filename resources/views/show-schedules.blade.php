<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $announcement->title }} Flea Market</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/line-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" >
    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="../assets/fonts/line-icons.css">
    <!-- Nivo Lightbox -->
    <link rel="stylesheet" type="text/css" href="../assets/css/nivo-lightbox.css" >
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    <!-- custom-style -->
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">

  <style>
    body {
      background-color: #f9f9f9;
      font-family: 'Segoe UI', sans-serif;
      padding-top: 40px;
    }

    .container {
      max-width: 900px;
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    h2 {
      color: #004d40;
      font-weight: bold;
      margin-bottom: 30px;
      font-size: 38px;
    }
    .flex-item {
    flex: 1 1 200px; 
    min-width: 200px;
    }

    .meta-label {
      font-weight: 600;
      color: #004d40;
      font-size: 17px;
    }

    .meta-value {
      color: #333;
      font-size: 17px;
    }

    .description {
      margin-top: 15px;
      font-size: 1.1rem;
      color: #555;
    }

    hr {
      border-top: 2px solid #07BEB8;
      margin: 40px 0;
    }

    h4 {
      color: #004d40;
      font-weight: 600;
      margin-bottom: 25px;
      text-align:center;
    }

    .img-fluid {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border-radius: 8px;
    }

    .btn-outline-primary:hover {
    background-color: transparent !important;
    color:white !important; /* Or your preferred color */
    border-color: #07BEB8 !important;
    box-shadow: none !important;
    }


    .btn-outline-primary {
      background-color: #07BEB8;
      color: white;
    }

    
  </style>
</head>
<body>

  
<div class="navbar navbar-expand-lg bg-inverse fixed-top scrolling-navbar custom-gradient-navbar" style="height:80px;">    
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
      ← Back
    </a>

    <!-- Title -->
    <h2 class="mb-0 text-center flex-grow-1" style="color: #004d40;">
      {{ $announcement->title }} Flea Market
    </h2>

    <!-- Spacer for alignment -->
    <div style="width: 75px;"></div>
  
</div>

<div class="container my-5">
<div class="mb-4 d-flex flex-wrap gap-4">
  <div class="flex-item">
    <p><span class="meta-label">📅 Date:</span>
      <span class="meta-value">{{ \Carbon\Carbon::parse($announcement->start_date)->format('d F') }}</span>
    </p>
  </div>
  <div class="flex-item">
    <p><span class="meta-label">🕒 Time:</span>
      <span class="meta-value">{{ \Carbon\Carbon::parse($announcement->time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($announcement->end_time)->format('h:i A') }}</span>
    </p>
  </div>
  <div class="flex-item">
    <p><span class="meta-label">📍 Venue:</span>
      <span class="meta-value">{{ $announcement->venue }}</span>
    </p>
  </div>
</div>

<p class="description mt-3">{{ $announcement->description }}</p>


    <hr>

    <h4>Event Gallery</h4>
    @if($images->count())
    <div class="row">
        @endif
  @forelse($images as $image)
    <div >
      <div>
        <img src="{{ asset('storage/' . ltrim($image->image_url, '/')) }}" class="img-fluid" alt="Event image" style="margin-left:145px;width:600px;max-height: 500px; margin-top: 10px;">
      </div>
    </div>
  @empty
    <div class="col-12">
      <p>No images available for this event.</p>
    </div>
  @endforelse
</div>


</body>

</html>
