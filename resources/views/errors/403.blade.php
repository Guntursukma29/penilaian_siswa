<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 | Akses Ditolak</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f97316, #facc15);
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .error-box {
            background: white;
            padding: 50px 60px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            text-align: center;
            max-width: 480px;
            animation: fadeIn 0.6s ease;
        }
        h1 {
            font-size: 90px;
            color: #f97316;
            margin: 0;
        }
        h2 {
            margin-top: 10px;
            font-size: 22px;
        }
        a {
            display: inline-block;
            margin-top: 25px;
            background: #f97316;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }
        a:hover {
            background: #ea580c;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-15px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="error-box">
        <h1>403</h1>
        <h2>Anda tidak memiliki akses ke halaman ini.</h2>
        <a href="{{ url('/home') }}">Kembali ke Beranda</a>
    </div>
</body>
</html>
