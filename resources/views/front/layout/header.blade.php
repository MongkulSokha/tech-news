<section id="header_section_wrapper" class="header_section_wrapper">
    <div class="container">
        <div class="header-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="left_section">
                        <span class="date">
                            {{ date('l') }} .
                        </span>
                        <!-- Date -->
                        <span class="time">
                            {{ date('j F. Y') }}
                        </span>
                        <!-- Time -->
                        <div class="social">
                            <a class="icons-sm fb-ic" href="https://www.facebook.com/sokha.mongkul.1"><i class="fa fa-facebook"></i></a>
                            <!--Google +-->
                            <a class="icons-sm inst-ic" href="https://www.linkedin.com/in/mongkul-sokha-74247626a/"><i class="fa fa-linkedin"> </i></a>
                        </div>
                        <!-- Top Social Section -->
                    </div>
                    <!-- Left Header Section -->
                </div>
                <div class="col-md-4">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('others') }}/{{ $shareData['front_logo'] }}"
                                alt="Tech News Logo" width=""></a>
                    </div>
                    <!-- Logo Section -->
                </div>
                <div class="col-md-4">
                    <div class="right_section">
                        <ul class="nav navbar-nav">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if (Auth::user()->type === 1)
                                            <a class="dropdown-item" href="{{ url('/back') }}">Dashboard</a>
                                        @endif

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            {{-- <li class="dropdown lang">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    EN<i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#">KH</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                        <!-- Language Section -->

                        <ul class="nav-cta hidden-xs">
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="head-search">
                                            <form role="search" action="{{ url('search') }}" method="GET">
                                                <div class="input-group">
                                                    <input type="search" class="form-control col-md-4 float-left"
                                                        value="{{ Request::get('search') }}" name="search"
                                                        id="search" placeholder="Search...">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary">Search</button>
                                                    </span>

                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- Search Section -->
                    </div>
                    <!-- Right Header Section -->
                </div>
            </div>
        </div>
        <!-- Header Section -->

        <div class="navigation-section">
            <nav class="navbar m-menu navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="#navbar-collapse-1" style="align-item: center;">
                        <ul class="nav navbar-nav main-nav">
                            <li class="active"><a href=" {{ url('/') }} ">Home</a></li>
                            @foreach ($shareData['categories'] as $category)
                                <li>
                                    <a href="{{ url('/category') }}/{{ $category->id }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                            {{-- @foreach ($shareData['author'] as $authors)
                                <li><a href="{{ url('/author') }}/{{ $authors->id }}">{{ $authors->name }}</a></li>
                            @endforeach --}}
                        </ul>
                    </div>
                    <!-- .navbar-collapse -->
                </div>
                <!-- .container -->
            </nav>
            <!-- .nav -->
        </div>
        <!-- .navigation-section -->
    </div>
    <!-- .container -->
</section>
