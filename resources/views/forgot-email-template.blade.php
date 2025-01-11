<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #4F46E5;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            color: #333;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #4F46E5;
            color: white !important; /* Menambahkan !important untuk memastikan warna tetap putih */
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            transition: background 0.3s;
        }
        .button:hover {
            background: #4338CA;
            color: white !important; /* Memastikan tetap putih saat hover */
        }
        .footer {
            background: #f8f8f8;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .note {
            font-size: 13px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reset Password</h1>
        </div>
        <div class="content">
            <p>Hai {{ $name }},</p>
            
            <p>Kami menerima permintaan untuk mengatur ulang password akun Anda. Jika Anda tidak melakukan permintaan ini, Anda bisa mengabaikan email ini.</p>
            
            <p>Untuk mengatur ulang password Anda, silakan klik tombol di bawah ini:</p>
            
            <center>
                <a href="{{ $link }}" class="button">Reset Password</a>
            </center>
            
            <p>Atau copy dan paste URL berikut ke browser Anda:</p>
            <p style="word-break: break-all; color: #4F46E5;">{{ $link }}</p>
            
            <div class="note">
                <p>Catatan penting:</p>
                <ul>
                    <li>Jika Anda tidak melakukan permintaan reset password, abaikan email ini</li>
                    <li>Jangan bagikan link ini kepada siapapun</li>
                </ul>
            </div>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Nama Perusahaan Anda. All rights reserved.</p>
        </div>
    </div>
</body>
</html>