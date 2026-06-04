<!DOCTYPE html>
<html>
<head>
    <tytle>Verifikasi Akun</title>
</head>
<body>
    <h2>Halo {{ $details['username'] }}!</h2>
    <p>Terima kasih telah mendaftar di DP3A Tolikara.</p>
    <p>Klik link di bawah ini untuk verifikasi akun Anda:</p>
    <p>
        <a href="{{ $details['url'] }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Verifikasi Akun
        </a>
    </p>
    <p>Atau klik link ini: <a href="{{ $details['url'] }}">{{ $details['url'] }}</a></p>
    <p>Waktu pendaftaran: {{ $details['datetime'] }}</p>
    <p>Website: {{ $details['website'] }}</p>
    <br>
    <p>Terima kasih,</p>
    <p><strong>Tim DP3A Tolikara</strong></p>
</body>
</html>