<!DOCTYPE html>
<html>
<head>
    <title>Xush kelibsiz!</title>
</head>
<body>
    <h2>Hurmatli {{ $user->name }},</h2>
    <p>Siz muvaffaqiyatli ro'yxatdan o'tdingiz.</p>
    <p>Tizimga kirish uchun ma'lumotlaringiz:</p>
    
    <p><strong>Login (Email):</strong> {{ $user->email }}</p>
    <p><strong>Parol:</strong> {{ $password }}</p>
    
    <br>
    <p>Iltimos, tizimga kirgandan so'ng parolingizni o'zgartiring.</p>
    <p>Hurmat bilan, <br> {{ config('app.name') }} jamoasi</p>
</body>
</html>