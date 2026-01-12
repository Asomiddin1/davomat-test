<!DOCTYPE html>
<html>
<head>
    <title>Xush kelibsiz!</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover { background-color: #0056b3; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hurmatli {{ $user->name }},</h2>
        <p>Siz muvaffaqiyatli ro'yxatdan o'tdingiz.</p>
        
        <p>Tizimga kirish uchun login ma'lumotlaringiz:</p>
        
        <div style="background: #f4f4f4; padding: 15px; border-radius: 5px;">
            <p style="margin: 5px 0;"><strong>Login (Email):</strong> {{ $user->email }}</p>
            <p style="margin: 5px 0;"><strong>Parol:</strong> {{ $password }}</p>
        </div>
        
        <br>
        <p>Tizimga kirish uchun pastdagi tugmani bosing:</p>
        
        <a href="https://davomat.ct.ws/auth/login" class="btn">Tizimga Kirish</a>
        
        <div class="footer">
            <p>Hurmat bilan, <br> {{ config('app.name') }} jamoasi</p>
        </div>
    </div>
</body>
</html>