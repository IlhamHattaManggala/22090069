<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center justify-content-lg-between">

    <h1 class="logo me-auto me-lg-0"><a href="{{ route('user.home') }}"><span>{{ $website->nama }}</span></a></h1>

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        @guest
        <li><a class="nav-link scrollto {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
        <li><a class="nav-link scrollto {{ Request::routeIs('karakter') ? 'active' : '' }}" href="{{ route('karakter') }}">Daftar Karakter</a></li>
        @endguest
        @auth
        <li><a class="nav-link scrollto {{ Request::routeIs('user.home') ? 'active' : '' }}" href="{{ route('user.home') }}">Beranda</a></li>
        <li><a class="nav-link scrollto {{ Request::routeIs('user.karakter') ? 'active' : '' }}" href="{{ route('user.karakter') }}">Daftar Karakter</a></li>
        <li><a class="nav-link scrollto {{ Request::routeIs('user.rekomendasi') ? 'active' : '' }}" href="{{ route('user.rekomendasi') }}">Rekomendasi Karakter</a></li>
        <li><a class="nav-link scrollto {{ Request::routeIs('user.feedback') ? 'active' : '' }}" href="{{ route('user.feedback') }}">Feedback</a></li>
        @endauth
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
    @auth
    <div class="profile-section d-flex align-items-center">
      @if(Auth::user()->base64Image)
      <img src="{{ Auth::user()->base64Image }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
      @else
      <img src="{{ asset('AdminLTE/dist/img/default-profile.png') }}" alt="Default Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
      @endif
      <div class="dropdown">
        <i class="bi bi-chevron-down text-white" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profil</a></li>
          <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a></li>
        </ul>
      </div>
    </div>
    @endauth
    @guest
    <a href="{{ route('login') }}" class="get-started-btn scrollto">Login & Register</a>
    @endguest

  </div>
</header>



<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>