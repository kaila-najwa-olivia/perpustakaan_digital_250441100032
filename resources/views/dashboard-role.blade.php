<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard {{ $role }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f8f5;
            color: #333;
        }

        .navbar {
            background: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5eee7;
        }

        .logo {
            font-size: 21px;
            font-weight: bold;
            color: #27834b;
        }

        .role {
            background: #e7f4eb;
            color: #27834b;
            padding: 9px 17px;
            border-radius: 20px;
            font-size: 14px;
        }

        .container {
            max-width: 950px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            border: 1px solid #e5eee7;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
        }

        .card h1 {
            color: #27834b;
            font-size: 27px;
            margin-bottom: 13px;
        }

        .card p {
            color: #68766b;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .info {
            background: #edf7ef;
            color: #356b45;
            padding: 16px;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">Perpustakaan Digital</div>
        <div class="role">{{ $role }}</div>
    </div>

    <div class="container">
        <div class="card">
            <h1>Selamat Datang, {{ $role }}!</h1>

            <p>{{ $deskripsi }}</p>

            <div class="info">
                Anda berhasil masuk ke halaman dashboard Perpustakaan Digital.
            </div>
        </div>
    </div>

</body>
</html>
