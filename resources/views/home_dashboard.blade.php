<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Dashboard</title>
    @vite(['resources/css/home_style.css'])    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="dashboard-container">
        
        <div class="teal-overlay"></div>

        <header class="navbar">
            <div class="search-bar">
                <input type="text" placeholder="search for vacation theme......">
                <button type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <div class="auth-section">
                {{-- Logika Blade untuk mengecek status Login --}}
                @auth
                    <a href="{{ url('/profile') }}" class="btn-login">
                        <i class="fa-solid fa-user"></i> My Profile
                    </a>
                @else
                    <a href="{{ url('/login') }}" class="btn-login">
                        <i class="fa-solid fa-user"></i> Log in
                    </a>
                @endauth
            </div>
        </header>

        <main class="hero-content">
            <h1>Share Your<br>Travel<br>Experience<br>Here</h1>
            
            <div class="action-buttons">
                {{-- Logika untuk tombol Share My Experience --}}
                @auth
                    <a href="{{ url('/share-experience') }}" class="btn-primary">Share My Experience</a>
                @else
                    <a href="{{ url('/login') }}" class="btn-primary">Share My Experience</a>
                @endauth

                <a href="{{ url('/explore') }}" class="btn-outline">Explore More</a>
            </div>
        </main>
        
    </div>

</body>
</html>