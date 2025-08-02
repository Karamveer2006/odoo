  <header>
    <nav class="navbar px-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CivicTrack</a>
            <button class="btn d-lg-none" id="menuToggle">
            <i class="fas fa-bars fa-lg"></i>
            </button>

            <label class="theme-toggle-switch">
            <input checked="true" id="toggleTheme" type="checkbox" />
            <span class="theme-toggle-slider">
                <div class="theme-toggle-star theme-toggle-star_1"></div>
                <div class="theme-toggle-star theme-toggle-star_2"></div>
                <div class="theme-toggle-star theme-toggle-star_3"></div>
                <svg viewBox="0 0 16 16" class="theme-toggle-cloud theme-toggle-cloud_1">
                <path
                    transform="matrix(.77976 0 0 .78395-299.99-418.63)"
                    fill="#fff"
                    d="m391.84 540.91c-.421-.329-.949-.524-1.523-.524-1.351 0-2.451 1.084-2.485 2.435-1.395.526-2.388 1.88-2.388 3.466 0 1.874 1.385 3.423 3.182 3.667v.034h12.73v-.006c1.775-.104 3.182-1.584 3.182-3.395 0-1.747-1.309-3.186-2.994-3.379.007-.106.011-.214.011-.322 0-2.707-2.271-4.901-5.072-4.901-2.073 0-3.856 1.202-4.643 2.925"
                ></path>
                </svg>
            </span>
            </label>

            <div class="d-none d-lg-flex align-items-center gap-3">
                @if (url()->current() != route('login') && url()->current() != route('register'))
                    @if (Session::has('user_id'))
                        <a class="text-dark text-decoration-none" href="{{route('my_issues')}}">My Issues</a>
                        <a class="text-dark text-decoration-none" href="{{route('issue.report')}}">Report new issue</a>
                        <a class="text-dark text-decoration-none" href="{{route('profile')}}">Profile</a>
                    @else
                    {{-- {{Session::get("user_id") ?? "k"}} --}}
                        <a class="text-dark text-decoration-none fw-semibold" href="{{route("login")}}">Login</a>
                        <a class="text-dark text-decoration-none fw-semibold" href="{{route("register")}}">Register</a>
                    @endif
                @else
                    <a class="text-dark text-decoration-none" href="{{route("home")}}">Home</a>
                @endif
            </div>
        </div>
    </nav>
</header>
<div class="sidebar" id="mobileMenu">
    @if (url()->current() != route('login') && url()->current() != route('register'))
        @if (Session::has('user_id'))
            <a href="{{route('my_issues')}}">My Issues</a>
            <a href="{{route('logout')}}">Logout</a>
            <a href="{{route('profile')}}">Profile</a>
        @else
            <a href="{{route("login")}}">Login</a>
            <a href="{{route("register")}}">Register</a>
        @endif
    @else
        <a href="{{route('home')}}" class="active">Home</a>
    @endif
  
</div>
<div class="menu-overlay" id="menuOverlay"></div>