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

<section class="buyer-dashboard">
  <h2 class="search-title">Search Results for "{{ request('query') }}"</h2>

  @if(count($results) > 0)
    <div class="product-wrapper">
      @foreach($results as $product)
        <div class="product-card">
          <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
          <h4>{{ $product['name'] }}</h4>
          <p class="price">KSh {{ $product['price'] }}</p>
          <p class="description">A beautifully crafted item perfect for you!</p>

          <div class="product-actions">
          <form action="{{ route('buyer.checkout') }}" method="GET">
            <input type="hidden" name="id" value="{{ $product->id }}">
            <button type="submit" class="btn buy-btn">Buy Now</button>
          </form>
            <button class="btn wishlist-btn"><a href="">Add to Wishlist</a></button>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <p style="text-align:center; margin-top: 20px;">No products found matching your search 😢</p>
  @endif
</section>


</body>
</html>
