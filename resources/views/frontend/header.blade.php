<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('images/company/' . $company->company_logo) }}" 
                alt="{{ $company->company_name ?? '' }}" class="img-fluid">
             <h1 class="sitename">{{ $company->company_name ?? '' }}</h1>
        </a>
        <nav id="navmenu" class="navmenu">
        <ul>
            <li>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('home') }}#about" class="">About</a>
            </li>
            <li class="dropdown">
                <a href="#" class="{{ request()->routeIs('service.show') ? 'active' : '' }}"><span>Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    @foreach($products as $product)
                        <li><a href="{{ route('service.show', $product->slug) }}">{{ $product->title }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </li>
            @if (Auth::check())
            <li class="dropdown">
                <a href="#"><span>{{Auth::user()->name ?? ''}}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </li>
            @else
            <li class="dropdown d-none">
                <a href="#"><span>Login/Register</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                </ul>
            </li>
            @endif
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>