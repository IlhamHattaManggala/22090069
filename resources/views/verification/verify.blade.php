<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('AdminLTE/dist/css/verif.css') }}">
    <title>Verifikasi Email</title>
</head>
<body>
    <div class="container">
        <h1>Halo, {{ $name }}</h1>
        <p>Terima kasih telah mendaftar. Silakan klik link berikut untuk verifikasi email Anda:</p>
        <p><a href="{{ $verificationUrl }}">Verifikasi Email</a></p>
    </div>
</body>
</html>
