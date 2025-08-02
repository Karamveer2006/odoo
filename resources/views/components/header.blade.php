  <header>
    <nav class="navbar navbar-light bg-white px-3 shadow-sm fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CivicTrack</a>
            <button class="btn d-lg-none" id="menuToggle">
            <i class="fas fa-bars fa-lg"></i>
            </button>
            <div class="d-none d-lg-flex align-items-center gap-3">
                @if (url()->current() != route('login') && url()->current() != route('register'))
                    <a class="text-dark text-decoration-none fw-semibold" href="{{route("login")}}">Login</a>
                    <a class="text-dark text-decoration-none fw-semibold" href="{{route("register")}}">Register</a>
                @else
                    <a class="text-dark text-decoration-none" href="{{route("home.index")}}">Home</a>
                @endif
            </div>
        </div>
    </nav>
</header>
<div class="sidebar" id="mobileMenu">
    @if (url()->current() != route('login') && url()->current() != route('register'))
        <a href="{{route("login")}}">Login</a>
        <a href="{{route("register")}}">Register</a>
    @else
        <a href="{{route('home')}}" class="active">Home</a>
    @endif
  
</div>
<div class="menu-overlay" id="menuOverlay"></div>