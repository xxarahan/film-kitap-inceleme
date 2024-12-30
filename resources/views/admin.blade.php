<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Kendi stil dosyanız -->
</head>
<body>
    <header class="bg-dark text-white text-center py-4">
        <h1>Welcome to Our Website</h1>
        <nav>
            <a href="/login" class="text-white me-3">🔓 Sign-in</a>
            <a href="/registration" class="text-white">📝 Sign-up</a>
        </nav>
    </header>

    <main class="container my-4">
        @yield('content') <!-- İçerik burada yer alacak -->
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>