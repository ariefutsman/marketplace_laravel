<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Portal Marketplace</title>
  <link rel="stylesheet" href="{{asset("css/style.css")}}">
  <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css")}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- CSS untuk membuat gambar seragam --}}
<style>
  /* Membuat semua gambar produk memiliki ukuran yang sama */
  .card {
    height: 100%;
    transition: transform 0.2s ease-in-out;
  }

  .card:hover {
    transform: translateY(-5px);
  }

  .card-img-top {
    width: 100%;
    height: 200px;
    object-fit: contain;  /* Diubah dari cover menjadi contain */
    object-position: center;
    background-color: #f8f9fa;
  }

  /* Responsif untuk layar kecil */
  @media (max-width: 768px) {
    .card-img-top {
      height: 180px;
    }
  }

  @media (max-width: 576px) {
    .card-img-top {
      height: 160px;
    }
  }
</style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">Junior Web Developer</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item mx-2">
            <a class="nav-link active" aria-current="page" href="{{route('home-page')}}">Home</a>
          </li>
          
          @if (Auth::check())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hi, {{Auth::user()->name}}
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li>
                  <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="dropdown-item">Logout</button></li>
                  </form>
                  
              </ul>
            </li>
          @else
            <li class="nav-item mx-2">
              <a class="btn btn-primary" href="{{route('login')}}">Sign In</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-3">
      {{-- Tampilkan Pesan Sukses --}}
      @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      {{-- Tampilkan Pesan Error/Gagal --}}
      @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
  </div>

  @yield('content')


  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
  </script>

  @yield('scripts')
</body>

</html>