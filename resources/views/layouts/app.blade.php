<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="/" style="font-size: 1.8rem; color: grey;">Job Portal</a>
        <div class="collapse navbar-collapse">
            <div class="container d-flex justify-content-center">
                
            </div>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('appliedJobs') }}">Applied</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ Auth::user()->name }}</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="main-content container mt-4">
        @yield('content')
    </div>
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
            <p>
                <a href="#" class="text-light mx-2">About Us</a> |
                <a href="#" class="text-light mx-2">Contact</a> |
                <a href="#" class="text-light mx-2">Privacy Policy</a>
            </p>
            <div class="social-icons mt-2">
                <a href="#" class="text-light mx-2"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
