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

        .product-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(168, 168, 168, 0.53);
            padding: 20px;
            max-width: 300px;
            width: 100%;
        }

        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product-card h4, h6 {
            color: #004d40;
            margin-bottom: 8px;
            font-size: 1.25rem;
        }

        .product-card .price {
            color: #00796b;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.25rem;
        }

        .product-card .description {
            color: #555;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .buy-btn, .wishlist-btn {
            flex: 1;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .buy-btn {
            background-color: #26a69a;
            color: white;
        }

        .buy-btn:hover {
            background-color: #2bbbad;
        }

        .wishlist-btn {
            background-color: #b2dfdb;
            color: #004d40;
        }

        .wishlist-btn:hover {
            background-color: #a7ffeb;
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
    <a href="/buyer/landing" class="navbar-brand">Flea Market</a>
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
            <a class="nav-link" href="{{ url('/buyer/landing') }}">
              <i class="lni-home"></i>Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/buyer/schedules') }}">
              <i class="lni-bullhorn"></i>Market Schedules
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
<h2 class="explore-heading">Explore Flea Market</h2>

<div class="product-grid">
  @forelse($products as $product)
    <div class="product-card">
      @if ($product->image_url)
        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-img">
      @endif

      <h4>{{ $product->name }}</h4>
      <h6>Vendor: {{ $product->vendor->shop_name ?? 'Unknown Vendor' }}</h6>
      <p class="price">KSh {{ number_format($product->price) }}</p>
      <p class="description">{{ $product->description }}</p>
      <div class="product-actions">
        <form action="{{ route('buyer.checkout') }}" method="GET">
          <input type="hidden" name="product_id" value="{{ $product->product_id }}">
          <button type="submit" class="buy-btn">Buy Now</button>
        </form>

        <form method="POST" action="{{ route('buyer.bookProduct') }}">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->product_id }}">
          <button type="submit" class="wishlist-btn">Wishlist</button>
        </form>
      </div>
    </div>
  @empty
    <p>No products available at the moment. Please check back later.</p>
  @endforelse
</div>
</div>
</div>
</body>
</html>