<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #e8f5e9, #f5faf6, #d1fae5);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            color: #263b32;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
        }

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo {
            width: 70px;
            height: 70px;
            background: #166534;
            color: white;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 20px rgba(22, 101, 52, 0.2);
        }

        .logo svg {
            width: 36px;
            height: 36px;
        }

        .brand h1 {
            font-size: 25px;
            font-weight: 700;
            color: #14532d;
        }

        .brand p {
            font-size: 13px;
            color: #64756a;
            margin-top: 5px;
        }

        .login-card {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(31, 73, 48, 0.10);
            border: 1px solid #e5eee7;
        }

        .login-card h2 {
            font-size: 21px;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .description {
            font-size: 13px;
            color: #7b8790;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d7e2da;
            border-radius: 9px;
            outline: none;
            font-family: inherit;
            font-size: 13px;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.10);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13px;
            color: #64756a;
            margin: 5px 0 22px;
        }

        .remember input {
            accent-color: #15803d;
            width: 16px;
            height: 16px;
        }

        .login-button {
            width: 100%;
            border: none;
            padding: 13px;
            background: #15803d;
            color: white;
            border-radius: 9px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #166534;
        }

        .forgot {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #15803d;
            text-decoration: none;
            margin-top: 15px;
        }

        .forgot:hover,
        .register a:hover {
            text-decoration: underline;
        }

        .register {
            text-align: center;
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid #edf1ed;
            font-size: 13px;
            color: #77847b;
        }

        .register a {
            display: inline-block;
            margin-top: 7px;
            color: #15803d;
            font-weight: 600;
            text-decoration: none;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .status {
            padding: 10px;
            background: #ecfdf5;
            color: #166534;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 18px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 25px 22px;
            }

            .brand h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="brand">
            <div class="logo">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21z"/>
                    <path d="M4 5.5v13A2.5 2.5 0 0 1 6.5 16H20"/>
                    <path d="M8 7h8"/>
                    <path d="M8 10h7"/>
                </svg>
            </div>

            <h1>Perpustakaan Digital</h1>
            <p>Temukan dan jelajahi berbagai koleksi buku</p>
        </div>

        <div class="login-card">

            <h2>Selamat Datang!</h2>
            <p class="description">
                Silakan masuk menggunakan akun kamu.
            </p>

            @if (session('status'))
                <div class="status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email kamu"
                        required
                        autofocus
                        autocomplete="username"
                    >

                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password"
                    >

                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <label class="remember">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>

                <button type="submit" class="login-button">
                    Masuk Sekarang
                </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">
                        Lupa password?
                    </a>
                @endif
            </form>

            <div class="register">
                Belum punya akun?
                <br>
                <a href="{{ route('register') }}">
                    Daftar sekarang
                </a>
            </div>

        </div>

    </div>

</body>
</html>
