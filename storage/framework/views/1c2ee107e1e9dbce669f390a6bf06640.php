<!DOCTYPE html>
<html>
<head>
    <title>Xush kelibsiz!</title>
</head>
<body>
    <h2>Hurmatli <?php echo e($user->name); ?>,</h2>
    <p>Siz muvaffaqiyatli ro'yxatdan o'tdingiz.</p>
    <p>Tizimga kirish uchun ma'lumotlaringiz:</p>
    
    <p><strong>Login (Email):</strong> <?php echo e($user->email); ?></p>
    <p><strong>Parol:</strong> <?php echo e($password); ?></p>
    
    <br>
    <p>Iltimos, tizimga kirgandan so'ng parolingizni o'zgartiring.</p>
    <p>Hurmat bilan, <br> <?php echo e(config('app.name')); ?> jamoasi</p>
</body>
</html><?php /**PATH /home/asomiddin/Desktop/davomat-2/resources/views/mails/student_created.blade.php ENDPATH**/ ?>