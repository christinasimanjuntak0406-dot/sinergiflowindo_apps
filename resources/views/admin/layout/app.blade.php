<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard') | Admin SINERGI FLOWINDO</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
  @stack('styles')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- NAVBAR -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- SIDEBAR -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light">SINERGI FLOWINDO</span>
    </a>

    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">

          <li class="nav-item">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/" target="_blank" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>Lihat Website</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/layanan') }}" class="nav-link {{ request()->is('admin/layanan*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-concierge-bell"></i>
              <p>Kelola Layanan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/produk') }}" class="nav-link {{ request()->is('admin/produk*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-box"></i>
              <p>Kelola Produk</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/categories') }}" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tags"></i>
              <p>Kelola Kategori</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/pesan-kontak') }}" class="nav-link {{ request()->is('admin/pesan-kontak*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Pesan Masuk</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/blog') }}" class="nav-link {{ request()->is('admin/blog*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>Kelola Blog</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>

    </div>
  </aside>

  <!-- CONTENT -->
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <h1>@yield('title', 'Dashboard')</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            @yield('content')
          </div>
        </div>
      </div>
    </section>

  </div>

  <!-- FOOTER -->
  <footer class="main-footer">
    <strong>&copy; 2026 SINERGI FLOWINDO</strong>
  </footer>

</div>

<!-- JS -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')

</body>
</html>