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

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            padding: 0 15px 50px;
        }

        #product-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px #07BEB8;
            padding: 20px;
            max-width: 800px;
            width: 100%;
            max-height: 100%;
        }

        #product-card h5 {
            color: #004d40;
            margin-bottom: 8px;
            font-size: 1.5rem;
        }
        #product-card h7 {
            color: #004d40;
            margin-bottom: 8px;
            font-size: 1.25rem;
        }

        #product-card .description {
            color: #555;
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .lni-bullhorn{
          position: absolute;
          z-index: 1000;
          left: 25px;
          top: 10px;
          font-size: 55px;
          color: #bababa;
          rotate: -10deg;

        }


    </style>

</head>
<body>

    <!-- Header Area wrapper Starts -->
<header id="header-wrap">
     <!-- Navbar Start -->
  <!-- Navbar -->

<nav class="navbar navbar-expand-lg bg-inverse fixed-top scrolling-navbar custom-gradient-navbar">
  <div class="container">
    <a href="/vendor/v-landing" class="navbar-brand">Flea Market</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
      <i class="lni-menu"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <!-- <form action="{{ url('/buyer/search') }}" method="GET" class="form-inline my-2 my-lg-0 mx-auto">
        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search products..." aria-label="Search" required>
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form> -->

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/vendor/dashboard') }}">
            <i class="lni-user"></i> Account
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="lni-exit"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h2 class="explore-heading">Explore Flea Market Schedules</h2>

<div class="product-grid">
  @forelse($announcements as $announcement)
  <div class="col-lg-4 col-md-6 col-xs-12">
        <div id="product-card">
        <i class="lni-bullhorn"></i>
          <div style="position: relative;top: 30px;padding: 20px;">
      <h5>{{ $announcement->title }} Flea Market</h5>
      <h7>Date: {{ $announcement->start_date }} to {{ $announcement->end_date }}</h7>
      <h7>Venue: {{ $announcement->venue }}</h7><br>
      <h7>Time: {{ $announcement->time }} - {{ $announcement->end_time }}</h7>
      <p class="description">{{ $announcement->description }}</p>
      
    </div>
    </div>
    </div>
  @empty
    <p>No flea market schedules available at the moment. Please check back later.</p>
  @endforelse
</div>
</div>
</div>
</body>
</html>