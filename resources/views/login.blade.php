<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Explore Horizons</title>
    @vite(['resources/css/login_style.css'])
</head>
<body>

    <div class="login-container" style="background: url('{{ asset('img/beach_login_bg.png') }}') no-repeat center center/cover;">
        
        <div class="login-left">
            <h1>EXPLORE<br>HORIZONS</h1>
            <p>Where Your Dream<br>Destinations<br>Become Reality</p>
        </div>

        <div class="login-right">
            <div class="glass-card">
                <form action="#" method="POST">
                    {{-- @csrf --}}
    
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                        @error('email')
                            <div class="error-message">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </div>
                        @enderror

                    <button type="submit" class="btn-signin">SIGN IN</button>
                </form>

                <div class="register-text">
                    Are you new? <a href="#">Register here</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>