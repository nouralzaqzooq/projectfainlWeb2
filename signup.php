<?php
include "db.php";

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // تعديل مهم: تشفير كلمة المرور لحمايتها في قاعدة البيانات وتتوافق مع password_verify
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = 1; // تعيين الحساب كـ Admin تلقائياً

    $sql = "INSERT INTO users (name, email, password, role) 
            VALUES ('$name', '$email', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('تم إنشاء الحساب المشفر بنجاح! يمكنك الآن تسجيل الدخول.'); window.location='login.php';</script>";
    } else {
        echo "خطأ في التسجيل: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب جديد</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; text-align: center; padding-top: 50px; }
        .form-container { background: white; padding: 20px; display: inline-block; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        input { display: block; margin: 10px auto; padding: 8px; width: 200px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>إنشاء حساب مسؤول جديد ومفر</h2>
    <form method="post">
        <input type="text" name="name" placeholder="الاسم الكامل" required>
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <input type="submit" name="signup" value="إنشاء الحساب">
    </form>
    <a href="login.php">لديك حساب بالفعل؟ سجل دخولك</a>
</div>

</body>
</html>
