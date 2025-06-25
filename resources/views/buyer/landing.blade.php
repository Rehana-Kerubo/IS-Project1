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


  </head>
  <body>

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
     <!-- Navbar Start -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-inverse fixed-top scrolling-navbar custom-gradient-navbar">
  <div class="container">
    <a href="/" class="navbar-brand">Flea Market</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
      <i class="lni-menu"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <form action="{{ url('/buyer/search') }}" method="GET" class="form-inline my-2 my-lg-0 mx-auto">
        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search products..." aria-label="Search" required>
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/buyer/explore-products') }}">
            <i class="lni-cart-full"></i> Explore Flea Market
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/buyer/view-acc') }}">
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

<!-- Navbar End -->

     <!-- Hero Area Start -->
     <div id="hero-area" class="hero-area-bg">
        <div class="overlay"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12">
              <div class="contents text-center">
                <div class="icon">
                  <i class="lni-cart-full"></i>
                </div>
                <h2 class="head-title">Hello, Welcome Back!</h2>
                <p class="banner-desc">Browse the best campus deals and reserve products in just a few clicks.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero Area End -->
    </header>

    <!-- Header Area wrapper End -->

    <!-- Count Bar Start -->
    <section id="count" class="wow fadeInUp" data-wow-delay="0.3s">
      <div class="container">
       <div class="row justify-content-center">
      <div class="col-10">
        <div class="count-wrapper text-center">
          <h2 class="flea-market-heading">{{ $announcement->title }} Flea Market Countdown</h2>
          <div class="time-countdown">
          <div id="clock" data-start="{{ \Carbon\Carbon::parse($announcement->start_date)->format('Y/m/d H:i:s') }}"></div>
          </div>
        </div>
      </div>
      </div>
     </div>
    </section>

    <!-- Count Bar End -->


    <!-- Information Bar Start -->
    <section id="information-bar">
      <div class="container">
       <div class="row inforation-wrapper">
      <div class="col-lg-3 col-md-6 col-xs-12">
        <ul>
          <li><i class="lni-map-marker"></i></li>
          <li><span><b>Venue</b> Strathmore University</span></li> <!-- updated -->
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 col-xs-12">
        <ul>
          <li><i class="lni-calendar"></i></li>
          <li><span><b>Date</b> {{ \Carbon\Carbon::parse($announcement->start_date)->format('F jS, Y') }}</span></li> <!-- updated -->

        </ul>
      </div>
      <div class="col-lg-3 col-md-6 col-xs-12">
        <ul>
          <li><i class="lni-mic"></i></li>
          <li><span><b>Vendors</b> 20+ Amazing Stalls</span></li> <!-- updated -->
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 col-xs-12">
        <ul>
          <li><i class="lni-user"></i></li>
          <li><span><b>Entry</b> Free for Everyone</span></li> <!-- updated -->
        </ul>
      </div>
      </div>
     </div>
    </section>

    <!-- Information Bar End -->


    <!-- product Section Start -->
<section class="buyer-dashboard">
  <h2 class="dashboard-title">Available Products</h2>
  <div class="product-wrapper">
  @foreach($products as $product)
    <div class="product-card">
      @if ($product->image_url)
        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-img">
      @endif

      <h4>{{ $product->name }}</h4>
      <p class="price">KSh {{ number_format($product->price) }}</p>
      <p class="description">{{ $product->description }}</p>

      <div class="product-actions">
      <form action="{{ route('buyer.checkout') }}" method="GET">
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <button type="submit" class="btn buy-btn">Buy Now</button>
      </form>

      <form method="POST" action="{{ route('buyer.bookProduct') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
    <button type="submit" class="btn wishlist-btn">Add to Wishlist</button>
</form>


    </div>
    </div>
  @endforeach
</div>

</section>
    <!-- product Section End -->


    
 <footer>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-12 col-xs-12">
            <div class="subscribe-inner wow fadeInDown" data-wow-delay="0.3s">
              
              
            </div>
            <div class="footer-logo">
              <!-- <img src="assets/img/logo.png" alt=""> -->
            </div>
            <div class="social-icons-footer">
              <ul>
                <li class="facebook"><a target="_blank" href="3"><i class="lni-facebook-filled"></i></a></li>
                <li class="twitter"><a target="_blank" href="3"><i class="lni-twitter-filled"></i></a></li>
                <li class="pinterest"><a target="_blank" href="3"><i class="lni-pinterest"></i></a></li>
              </ul>
            </div>
            <div class="site-info">
              <p>Designed and Developed by Rehana And Grace🫶🏼🫶🏼</p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Go to Top Link -->
    <a href="#" class="back-to-top">
    	<i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
      <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
      </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery-min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/jquery.nav.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/wow.js"></script>
    <script src="../assets/js/nivo-lightbox.js"></script>
    <script src="../assets/js/video.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/custom.js"></script>  

    <!-- <script>
  $(document).ready(function () {
    console.log("jQuery loaded!");
    $('[data-toggle="dropdown"]').dropdown(); // manually activate dropdowns
  });
</script> -->

        
      
  </body>
</html>
