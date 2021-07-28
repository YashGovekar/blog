<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/home-assets/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/home-assets/css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('index') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Home</a></li>
                @if (! auth()->check())

                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('auth.login.index') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('auth.register.index') }}">Register</a></li>

                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link px-lg-3 py-3 py-lg-4 dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Posts
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('posts.create') }}">Create Post</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.posts') }}">My Posts</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" onclick="document.getElementById('logout-form').submit()">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="javascript:void(0)">Logout</a>
                        <form method="post" id="logout-form" action="{{ route('auth.logout') }}">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<header class="masthead"
    @hasSection('bg_img')
        style="background-image: url(@yield('bg_img'))"
    @else
        style="background-image: url('/home-assets/assets/img/home-bg.jpg')"
    @endif
>
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>@yield('title')</h1>
                    <span class="subheading">
                        @yield('sub_title')
                    </span>
                    @hasSection('meta')
                        <span class="meta">
                            @yield('meta')
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    @include('flash::message')
</div>

@yield('content')

<!-- Footer-->
<footer class="border-top mt-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://www.linkedin.com/in/yash-govekar-13856617b/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com/YashGovekar" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com/yashgovekar55" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; {{ config('app.name') }} 2021</div>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="/home-assets/js/scripts.js"></script>

@yield('scripts')
</body>
</html>
