<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="7850d56f-8d94-4acb-8dd3-3242a7056233";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SALCAS TRIFT SHOP') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        :root {
            --matcha-green: #A8D8B9;
            --deep-sea-blue: #2E5266;
            --soft-white: #F5F5F5;
            --dark-charcoal: #333333;
        }

        body {
            background-color: var(--soft-white);
            color: var(--dark-charcoal);
            font-family: 'Inter', sans-serif;
        }

        .navbar {
            background-color: var(--deep-sea-blue);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--matcha-green) !important;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--matcha-green) !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--matcha-green);
        }

        .dropdown-menu {
            background-color: var(--deep-sea-blue);
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(168, 216, 185, 0.1);
            color: var(--matcha-green);
        }

        .btn-primary {
            background-color: var(--matcha-green);
            border: none;
            color: var(--deep-sea-blue);
            padding: 8px 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(168, 216, 185, 0.3);
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(46, 82, 102, 0.2);
            color: var(--dark-charcoal);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.9);
            border-color: var(--matcha-green);
            box-shadow: 0 0 0 3px rgba(168, 216, 185, 0.1);
        }

        .pagination .page-link {
            background-color: #ffffff;
            border: 1px solid rgba(46, 82, 102, 0.2);
            color: var(--deep-sea-blue);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--matcha-green);
            border-color: var(--matcha-green);
            color: var(--deep-sea-blue);
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index_product') }}">
                    <i class="fas fa-leaf me-2"></i>SALCAS TRIFT
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link active" href="{{ route('index_product') }}">Products</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active" href="{{ route('show_cart') }}">Cart</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active" href="{{ route('index_order') }}">Orders</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-2"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->is_admin)
                                <li><a class="dropdown-item" href="{{ route('create_product') }}">
                                    <i class="fas fa-plus-circle me-2"></i>New Product
                                </a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('show_profile') }}">
                                    <i class="fas fa-user-cog me-2"></i>Profile
                                </a></li>
                                <li><hr class="dropdown-divider bg-secondary"></li>
                                <li>
                                <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                            </form>
                       </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>