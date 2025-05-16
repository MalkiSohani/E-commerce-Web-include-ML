<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('welcome') }}"> <img style="width:40px;"
                            src="{{ asset('assets/img/logo.png') }}" alt="logo"> {{ env('APP_NAME') }}</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            @if (Auth::user())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">Welcome {{ Auth::user()->name }}</a>
                                </li>
                                @if (Auth::user()->usertype == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}">Dashboard</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders') }}">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registration</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="hearer_icon d-flex">
                        <a href="{{ route('cart.view') }}"><i class="fas fa-cart-plus"></i></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
