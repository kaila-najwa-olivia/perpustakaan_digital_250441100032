<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan-250441100032 </title>

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
            padding: 30px 20px;
            color: #263b32;
        }

        .register-container {
            width: 100%;
            max-width: 460px;
        }

        .brand {
            text-align: center;
            margin-bottom: 22px;
        }

        .logo {
            width: 65px;
            height: 65px;
            background: #166534;
            color: white;
            border-radius: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 12px;
            box-shadow: 0 8px 20px rgba(22, 101, 52, 0.2);
        }

        .logo svg {
            width: 34px;
            height: 34px;
        }

        .brand h1 {
            font-size: 23px;
            font-weight: 700;
            color: #14532d;
        }

        .brand p {
            font-size: 12px;
            color: #64756a;
            margin-top: 5px;
        }

        .register-card {
            background: white;
            padding: 30px 34px;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(31, 73, 48, 0.10);
            border: 1px solid #e5eee7;
        }

        .register-card h2 {
            font-size: 21px;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .description {
            font-size: 12px;
            color: #7b8790;
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 7px;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 11px 13px;
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

        .error {
            color: #dc2626;
            font-size: 11px;
            margin-top: 5px;
        }

        .register-button {
            width: 100%;
            border: none;
            padding: 12px;
            background: #15803d;
            color: white;
            border-radius: 9px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }

        .register-button:hover {
            background: #166534;
        }

        .login-link {
            text-align: center;
            margin-top: 21px;
            padding-top: 18px;
            border-top: 1px solid #edf1ed;
            font-size: 13px;
            color: #77847b;
        }

        .login-link a {
            display: inline-block;
            margin-top: 6px;
            color: #15803d;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 25px 22px;
            }

            .brand h1 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">

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

            <h1>Perpustakaan-250441100032 </h1>
            <p>Bergabung dan jelajahi berbagai koleksi buku</p>
        </div>

        <div class="register-card">

            <h2>Buat Akun Baru</h2>
            <p class="description">
                Silakan lengkapi data berikut untuk mendaftar.
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                        autocomplete="name"
                    >

                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
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
                        placeholder="Buat password"
                        required
                        autocomplete="new-password"
                    >

                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="register-button">
                    Daftar Sekarang
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun?
                <br>
                <a href="{{ route('login') }}">
                    Masuk sekarang
                </a>
            </div>

        </div>

    </div>

</body>
</html>