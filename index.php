<?php
include "db.php";
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* خلفية انسيابية متدرجة ومريحة للعين بألوان الأزرق الداكن الصافي */
        body { 
            background: linear-gradient(135deg, #f5f7fa 0%, #e4ecf7 100%); 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* لمسة انسيابية ناعمة في الخلفية */
        body::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(37,99,235,0.08) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: 0;
        }

        /* هيدر ناعم وشفاف مدمج مع الخلفية بالأزرق الداكن */
        header { 
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 20px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            z-index: 1;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .header-main h1 { font-size: 22px; color: #1e40af; font-weight: 700; }
        .header-main p { font-size: 13px; color: #4b5563; margin-top: 2px; }
        
        /* زر خروج ناعم مستدير الحواف */
        .btn-logout { 
            background-color: #fee2e2; 
            color: #ef4444; 
            text-decoration: none; 
            padding: 8px 18px; 
            border-radius: 20px; 
            font-size: 13px; 
            font-weight: 600; 
            transition: all 0.3s ease; 
        }
        .btn-logout:hover { background-color: #ef4444; color: white; }

        /* الحاوية الرئيسية للكروت */
        .container { 
            max-width: 1140px; 
            width: 100%; 
            margin: 40px auto; 
            padding: 0 24px; 
            flex: 1; 
            z-index: 1;
        }
        .grid-layout { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: 30px; 
        }
        
        /* التصميم الزجاجي الشفاف الأنيق (Glassmorphism) */
        .card { 
            background: rgba(255, 255, 255, 0.75); 
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px; 
            padding: 30px; 
            display: flex; 
            flex-direction: column; 
            gap: 15px; 
            border: 1px solid rgba(255, 255, 255, 0.6); 
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.03);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); 
            position: relative;
        }
        /* تأثير مميز جداً عند تمرير الماوس لتشع باللون الأزرق المطور */
        .card:hover { 
            transform: translateY(-8px); 
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 12px 40px 0 rgba(37, 99, 235, 0.1);
            border-color: rgba(37, 99, 235, 0.25);
        }
        
        /* أيقونة الكرت بشكل ناعم وجميل */
        .card-icon { 
            font-size: 28px; 
            margin-bottom: 5px;
            text-align: right;
        }

        .card h3 { font-size: 18px; color: #1e293b; font-weight: 700; text-align: right; }
        .card p { font-size: 13.5px; color: #64748b; line-height: 1.6; text-align: right; margin-bottom: 15px; }
        
        /* زر الدخول مستدير بالكامل ويتحرك بسلاسة */
        .card a { 
            background: #ffffff;
            color: #2563eb; 
            text-decoration: none; 
            text-align: center; 
            padding: 10px; 
            border-radius: 25px; 
            font-size: 13px; 
            font-weight: 600; 
            transition: all 0.3s ease; 
            display: block; 
            border: 1px solid #cbd5e1;
            margin-top: auto;
        }
        /* تلوين خلفية الزر عند التقريب منه ليتناسق مع خيارك المفضل */
        .card a:hover { 
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); 
            color: white; 
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        /* فوتر ملوّن فخم ومكتوب فيه الإيميلين تواصل بشكل بروفيشينال */
        .simple-footer { 
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%); 
            color: #f7fafc; 
            text-align: center; 
            padding: 15px; 
            font-size: 12px; 
            font-weight: 500; 
            box-shadow: 0 -1px 8px rgba(0,0,0,0.05); 
            line-height: 1.8;
            z-index: 1;
        }
        .simple-footer a { color: #fff; text-decoration: underline; font-weight: bold; }
    </style>
</head>
<body>

    <!-- الهيدر الشفاف الناعم -->
    <header>
        <div class="header-main">
            <h1>نظام إدارة المدرسة</h1>
            <p>مرحباً بكِ في لوحة التحكم الإدارية المتكاملة</p>
        </div>
        <a href="logout.php" class="btn-logout">تسجيل الخروج 🚪</a>
    </header>

    <!-- حاوية شبكة العرض الزجاجية -->
    <div class="container">
        <div class="grid-layout">
            
            <!-- كرت الطلاب -->
            <div class="card">
                <div class="card-icon">🎓</div>
                <h3>شؤون الطلاب</h3>
                <p>إعادة ضبط وإدارة ملفات الطلاب، إضافة سجلات جديدة، والتعديل أو الحذف السريع للبيانات الحالية.</p>
                <a href="students.php">دخول القسم ←</a>
            </div>

            <!-- كرت المعلمين -->
            <div class="card">
                <div class="card-icon">💼</div>
                <h3>كادر المعلمين</h3>
                <p>تسجيل المدرسين الجدد، تحديث التخصصات التدريسية والمحافظة على دقة سجلات الهواتف والبريد.</p>
                <a href="teachers.php">دخول القسم ←</a>
            </div>

            <!-- كرت المواد الدراسية -->
            <div class="card">
                <div class="card-icon">📖</div>
                <h3>المواد الدراسية</h3>
                <p>إدخال المقررات والمساقات التعليمية، ضبط أرقام الأكواد، وتنسيق ربط المواد بأساتذتها.</p>
                <a href="subjects.php">دخول القسم ←</a>
            </div>

            <!-- كرت الدرجات -->
            <div class="card">
                <div class="card-icon">📈</div>
                <h3>رصد الدرجات</h3>
                <p>رصد ومتابعة علامات الطلاب، وضمان مطابقتها للمعرفات الحقيقية والتحكم بالسجلات بسلاسة.</p>
                <a href="grades.php">دخول القسم ←</a>
            </div>

            <!-- كرت المستخدمين -->
            <div class="card">
                <div class="card-icon">🛡️</div>
                <h3>إدارة الحسابات</h3>
                <p>التحكم بحسابات المسؤولين (Admins)، تعديل الصلاحيات، وضمان تشفير كلمات المرور بالموقع.</p>
                <a href="users.php">دخول القسم ←</a>
            </div>

        </div>
    </div>

    <!-- الفوتر الأزرق المطور الحامل لبيانات تواصل الإيميلين -->
    <footer class="simple-footer">
        <div>نظام إدارة المدرسة المطور © ٢٠٢٦</div>
        <div>للتواصل والدعم الفني عبر البريد الإلكتروني: 
            <a href="mailto:nouralzaqzooq@gmail.com">nouralzaqzooq@gmail.com</a> | 
            <a href="mailto:noorissa@gmail.com">noorissa@gmail.com</a>
        </div>
    </footer>

</body>
</html>
