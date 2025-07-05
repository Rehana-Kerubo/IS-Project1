<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Flea Market</title>

    <!-- Bootstrap CSS -->
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
        .explore-heading {
            text-align: center;
            margin-top: 120px;
            margin-bottom: 30px;
            color:rgb(0, 0, 0);
            font-size: 2.5rem;
            font-weight: bold;
        }

        .section-divider {
          display: flex;
          align-items: center;
          text-align: center;
          margin: 60px 0 30px;
      }
      .section-divider span {
          font-size: 1.6rem;
          font-weight: 600;
          padding: 0 20px;
          color: #004d40;
          position: relative;
          background-color: #fff;
          z-index: 1;
      }
      .section-divider::before {
          content: "";
          flex-grow: 1;
          height: 2px;
          background-color: #07BEB8;
          margin-right: 20px;
      }
      .section-divider::after {
          content: "";
          flex-grow: 1;
          height: 2px;
          background-color: #07BEB8;
          margin-left: 20px;
      }

      .flea-row {
          padding: 20px 30px;
          margin-bottom: 30px;
          background-color: #fff;
          border-left: 5px solid #07BEB8;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
          border-radius: 8px;
      }

      .row-info h5 {
          color: #004d40;
          margin-bottom: 10px;
          font-size: 1.5rem;
      }
      .flea-row:hover{
        background-color:rgba(100, 100, 100, 0.17);
      }

      .meta {
          font-size: 1.1rem;
          color: #004d40;
          margin-bottom: 6px;
          font-weight: 500;
      }

      .description {
          font-size: 1rem;
          color: #555;
          margin-top: 10px;
      }



    </style>
</head>
<body>
    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
     <!-- Navbar Start -->
<!-- Navbar -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-inverse fixed-top scrolling-navbar custom-gradient-navbar">
      <div class="container">
      <a href="/" class="navbar-brand">Flea Market</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
         <i class="lni-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto w-100 justify-content-end">
            <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link" href="#schedules">Schedules</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link" href="#google-map-area">Contact Us</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link" href="#">Sign Up</a></li> -->
            <li class="nav-item"><a class="nav-link" href="{{ url('login-register')}}">Login</a></li>
        </ul>
      </div>
     </div>
</nav>
<h2 class="explore-heading">Explore Flea Market Schedules</h2>

<div class="container mb-5">

  {{-- Upcoming Events --}}
  <div class="section-divider">
    <span>Upcoming Flea Markets</span>
  </div>
  @forelse($upcomingAnnouncements as $announcement)
    <div class="flea-row">
    <a href="{{ route('schedules.show', $announcement->announcement_id) }}">
      <div class="row-info">
        <h5>{{ $announcement->title }} Flea Market</h5>
        <p class="meta">📅 {{ \Carbon\Carbon::parse($announcement->start_date)->format('d F') }} </p>
        <p class="meta">📍 {{ $announcement->venue }}</p>
        <p class="meta">🕒 {{ \Carbon\Carbon::parse($announcement->time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($announcement->end_time)->format('h:i A') }}</p>
        <p class="description">{{ $announcement->description }}</p>
      </div>
    </a>
    </div>
  @empty
    <p class="text-center">No upcoming flea markets.</p>
  @endforelse

  {{-- Previous Events --}}
  <div class="section-divider mt-5">
    <span>Previous Flea Markets</span>
  </div>
  @forelse($previousAnnouncements as $announcement)
  <div class="flea-row">
  <a href="{{ route('schedules.show', $announcement->announcement_id) }}">
    <div class="row-info">
      <h5>{{ $announcement->title }} Flea Market</h5>
      <p class="meta">📅 {{ \Carbon\Carbon::parse($announcement->start_date)->format('d F') }} – {{ \Carbon\Carbon::parse($announcement->end_date)->format('d F') }}</p>
      <p class="meta">📍 {{ $announcement->venue }}</p>
      <p class="meta">🕒 {{ \Carbon\Carbon::parse($announcement->time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($announcement->end_time)->format('h:i A') }}</p>
      <p class="description">{{ $announcement->description }}</p>

    </div>
  </a>
  </div>


  @empty
    <p class="text-center">No previous flea markets.</p>
  @endforelse

</div>
</body>
</html>