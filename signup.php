<?php
include "db.php";

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // تشفير كلمة المرور لحمايتها في قاعدة البيانات وتتوافق مع password_verify
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد | نظام إدارة المدرسة</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* هيدر رسمي ونظيف جداً بدون أجزاء إضافية على اليسار */
        header { background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%); color: white; padding: 16px 40px; display: flex; justify-content: flex-start; align-items: center; box-shadow: 0 1px 8px rgba(0,0,0,0.05); }
        .header-title { display: flex; align-items: center; gap: 10px; }
        header h1 { font-size: 20px; font-weight: 600; letter-spacing: 0.5px; }

        /* حاوية العرض لتوسيط المربع تماماً في الشاشة */
        .main-wrapper { flex: 1; display: flex; justify-content: center; align-items: center; padding: 40px 20px; }

        /* صندوق إنشاء الحساب المبروز بدقة والمتوسط في الشاشة */
        .login-card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 25px rgba(0,0,0,0.04); max-width: 420px; width: 100%; text-align: center; border: 2px solid #2563eb; }
        .login-card h2 { color: #2d3748; margin-bottom: 25px; font-size: 24px; position: relative; padding-bottom: 10px; }
        .login-card h2::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 50px; height: 3px; background-color: #1e40af; border-radius: 2px; }

        /* تصميم الحقول والمدخلات المودرن */
        .input-group { margin-bottom: 20px; text-align: right; }
        .input-group label { display: block; margin-bottom: 6px; color: #4a5568; font-size: 14px; font-weight: 500; }
        .input-group input { width: 100%; padding: 11px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s ease; outline: none; background-color: #f7fafc; }
        .input-group input:focus { border-color: #2563eb; background-color: #fff; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15); }

        /* زر الإرسال */
        .btn-login { width: 100%; padding: 12px; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: opacity 0.3s ease; margin-top: 10px; }
        .btn-login:hover { opacity: 0.9; }

        /* رابط التبديل لصفحة تسجيل الدخول */
        .login-link { display: block; margin-top: 20px; font-size: 13px; color: #2563eb; text-decoration: none; font-weight: 500; }
        .login-link:hover { text-decoration: underline; }

        /* الفوتر الملون الحامل لإيميلات التواصل الهامة */
        .simple-footer { background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%); color: #f7fafc; text-align: center; padding: 12px; font-size: 12px; font-weight: 500; box-shadow: 0 -1px 8px rgba(0,0,0,0.05); line-height: 1.6; }
        .simple-footer a { color: #fff; text-decoration: underline; font-weight: bold; }
    </style>
</head>
<body>

    <!-- الهيدر الرسمي المحدث بالشعار الجديد ومن طرف واحد فقط -->
    <header>
        <div class="header-title">
            <span style="font-size: 22px;">🎓</span> <!-- شعار التخرج الرسمي الناعم -->
            <h1>نظام إدارة المدرسة</h1>
        </div>
    </header>

    <!-- حاوية العرض المحدثة للتوسيط العالي -->
    <div class="main-wrapper">
        
        <!-- صندوق نموذج إنشاء الحساب المتناسق -->
        <div class="login-card">
            <h2>إنشاء حساب مسؤول</h2>
            
            <form method="post">
                <div class="input-group">
                    <label for="name">الاسم الكامل:</label>
                    <input type="text" id="name" name="name" placeholder="الاسم الكامل" required>
                </div>

                <div class="input-group">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="email" id="email" name="email" placeholder="البريد الإلكتروني" required>
                </div>

                <div class="input-group">
                    <label for="password">كلمة المرور:</label>
                    <input type="password" id="password" name="password" placeholder="كلمة المرور" required>
                </div>

                <button type="submit" name="signup" class="btn-login">إنشاء الحساب</button>
                <a href="login.php" class="login-link">لديكِ حساب بالفعل؟ سجلي دخولكِ من هنا</a>
            </form>
        </div>

    </div>

    <!-- الفوتر الحامل لبيانات التواصل لكِ ولزميلتكِ -->
    <footer class="simple-footer">
        <div>نظام الإدارة المدرسية المطور © ٢٠٢٦</div>
        <div>للتواصل والدعم الفني عبر البريد الإلكتروني: 
            <a href="mailto:nouralzaqzooq@gmail.com">nouralzaqzooq@gmail.com</a> | 
            <a href="mailto:noorissa@gmail.com">noorissa@gmail.com</a>
        </div>
    </footer>

</body>
</html>
