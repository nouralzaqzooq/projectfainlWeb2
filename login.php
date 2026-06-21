<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | نظام إدارة المدرسة</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* هيدر باللون الأزرق الداكن الصافي والحيوّي */
        header { background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%); color: white; padding: 14px 35px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 8px rgba(0,0,0,0.05); }
        .header-title { display: flex; align-items: center; gap: 8px; }
        header h1 { font-size: 20px; font-weight: 600; }
        header .school-logo { font-size: 13px; background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 15px; display: flex; align-items: center; gap: 6px; }

        /* حاوية العرض المقسومة */
        .main-wrapper { flex: 1; display: flex; justify-content: center; align-items: center; padding: 40px 20px; max-width: 900px; margin: 0 auto; width: 100%; gap: 30px; }
        
        /* الجزء الترحيبي الجانبي بالأزرق الداكن الصافي */
        .welcome-panel { flex: 1; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: center; height: 395px; border: 2px solid #1e40af; }
        .welcome-panel h3 { font-size: 22px; margin-bottom: 15px; border-bottom: 2px solid rgba(255,255,255,0.2); padding-bottom: 10px; }
        .welcome-panel p { font-size: 14px; line-height: 1.6; color: #e2e8f0; margin-bottom: 20px; }
        .feature-item { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; font-size: 13px; background: rgba(255,255,255,0.08); padding: 8px 12px; border-radius: 6px; }

        /* صندوق تسجيل الدخول مع الإطار الأزرق المطور */
        .login-card { flex: 1; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); max-width: 400px; width: 100%; text-align: center; height: 395px; display: flex; flex-direction: column; justify-content: center; border: 2px solid #2563eb; }
        .login-card h2 { color: #2d3748; margin-bottom: 25px; font-size: 22px; position: relative; padding-bottom: 10px; }
        .login-card h2::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 40px; height: 3px; background-color: #1e40af; border-radius: 2px; }

        /* رسائل الأخطاء */
        .error-msg { background-color: #fff5f5; color: #c53030; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 13px; text-align: right; border-right: 4px solid #c53030; }

        /* تصميم الحقول والمدخلات */
        .input-group { margin-bottom: 15px; text-align: right; }
        .input-group label { display: block; margin-bottom: 6px; color: #4a5568; font-size: 13px; font-weight: 500; }
        .input-group input { width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s ease; outline: none; background-color: #f7fafc; }
        .input-group input:focus { border-color: #2563eb; background-color: #fff; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15); }

        /* زر الدخول */
        .btn-login { width: 100%; padding: 11px; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: opacity 0.3s ease; margin-top: 10px; }
        .btn-login:hover { opacity: 0.9; }

        /* فوتر ملون ومطور يشمل التوجيه للتواصل بالإيميل */
        .simple-footer { background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%); color: #f7fafc; text-align: center; padding: 12px; font-size: 12px; font-weight: 500; box-shadow: 0 -1px 8px rgba(0,0,0,0.05); line-height: 1.6; }
        .simple-footer a { color: #fff; text-decoration: underline; font-weight: bold; }
    </style>
</head>
<body>

    <!-- الهيدر -->
    <header>
        <div class="header-title">
            <span style="font-size: 20px;">🏫</span> 
            <h1>نظام إدارة المدرسة</h1>
        </div>
        <div class="school-logo">
            <span style="font-size: 14px;">👨‍🏫</span> 
            بوابة الإدارة الإلكترونية
        </div>
    </header>

    <!-- حاوية العرض المقسومة -->
    <div class="main-wrapper">
        
        <!-- اللوحة الترحيبية الجانبية -->
        <div class="welcome-panel">
            <h3>مرحباً بك في المنظومة الرقمية ✨</h3>
            <p>لوحة تحكم ذكية وشاملة مخصصة لإدارة شؤون الطلاب، تسجيل المعلمين، رصد الدرجات، ومتابعة المواد الدراسية بكفاءة عالية وأمان تام.</p>
            
            <div class="feature-item"><span>📊</span> إدارة كاملة للبيانات والتقارير</div>
            <div class="feature-item"><span>🔒</span> حماية البيانات بكلمات مرور مشفرة</div>
            <div class="feature-item"><span>⚡</span> استجابة سريعة للعمليات والـ CRUD</div>
        </div>

        <!-- صندوق تسجيل الدخول المبروز -->
        <div class="login-card">
            <h2>تسجيل الدخول</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-msg">
                    <?php 
                        if($_GET['error'] == "Email is empty") echo "الرجاء كتابة البريد الإلكتروني!";
                        elseif($_GET['error'] == "password is empty") echo "الرجاء كتابة كلمة المرور!";
                        else echo "البريد الإلكتروني أو كلمة المرور غير صحيحة!";
                    ?>
                </div>
            <?php endif; ?>

            <form action="validateLogin.php" method="post">
                <div class="input-group">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                </div>

                <div class="input-group">
                    <label for="password">كلمة المرور:</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" name="submit" class="btn-login">دخول إلى النظام</button>
            </form>
        </div>

    </div>

    <!-- الفوتر المطور مع إيميل التواصل المحدث -->
    <footer class="simple-footer">
        <div>نظام الإدارة المدرسية المطور © ٢٠٢٦</div>
        <div>للتواصل والدعم الفني عبر البريد الإلكتروني: 
            <a href="mailto:nouralzaqzooq@gmail.com">nouralzaqzooq@gmail.com</a> أو 
            <a href="mailto:noorissa@gmail.com">noorissa@gmail.com</a>
        </div>
    </footer>

</body>
</html>
