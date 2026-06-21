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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { 
            background-color: #f3f7fa; 
            min-height: 100vh; 
            display: flex; 
            overflow-x: hidden;
        }

        /* 1. القائمة الجانبية: تدرج أفقي فخم وعميق (اليمين داكن جداً واليسار أفتح) */
        .sidebar {
            width: 260px;
            background: linear-gradient(to left, #0b1e47 0%, #1d4ed8 100%); 
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            z-index: 100;
            box-shadow: -4px 0 25px rgba(11, 30, 71, 0.15);
        }

        .sidebar-brand {
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            padding: 0 20px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar-menu a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.12);
            border-right: 4px solid #3b82f6;
        }

        /* زر الخروج بتدرج كريستالي أحمر ناري يلمع */
        .sidebar .btn-logout { 
            background: linear-gradient(to left, #b91c1c 0%, #ef4444 100%);
            color: white; 
            text-decoration: none; 
            margin: auto 15px 20px 15px;
            padding: 11px;
            border-radius: 6px; 
            font-size: 13.5px; 
            font-weight: bold; 
            text-align: center;
            display: block;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.25), inset 0 8px 8px rgba(255, 255, 255, 0.2);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* 2. منطقة المحتوى الرئيسي */
        .main-content {
            margin-right: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header { 
            background: #ffffff;
            padding: 15px 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid #e2e8f0;
        }
        .header-main h1 { font-size: 19px; color: #0f172a; font-weight: 700; }
        .header-main p { font-size: 12.5px; color: #475569; margin-top: 2px; }

        .container { 
            width: 100%; 
            padding: 35px; 
            flex: 1; 
        }
        
        .grid-layout { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); 
            gap: 25px; 
        }
        
        /* 3. البطاقات وتأثير تدرج الحواف الأفقي الفخم (اليمين غامق لليسار فاتح) */
        .card { 
            background: #ffffff; 
            border-radius: 12px; 
            padding: 24px; 
            display: flex; 
            flex-direction: column; 
            gap: 12px; 
            border: 1px solid #e2e8f0; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            position: relative;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        /* الحافة اليمنى المتدرجة أفقياً */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 6px; 
        }
        
        /* تدرج الحواف: غامق ومُشبع من اليمين ويختفي بنعومة باتجاه اليسار */
        .card-students::before { background: linear-gradient(to left, #0f46bd 0%, rgba(15, 70, 189, 0) 100%); } 
        .card-teachers::before { background: linear-gradient(to left, #00875a 0%, rgba(0, 135, 90, 0) 100%); } 
        .card-subjects::before { background: linear-gradient(to left, #b86b00 0%, rgba(184, 107, 0, 0) 100%); } /* ذهبي غامق حقيقي */ 
        .card-grades::before   { background: linear-gradient(to left, #5322bd 0%, rgba(83, 34, 189, 0) 100%); } 
        .card-users::before    { background: linear-gradient(to left, #ab1254 0%, rgba(171, 18, 84, 0) 100%); }  

        .card-header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card h3 { font-size: 17px; color: #0f172a; font-weight: 700; }
        
        /* علب الأيقونات الصغيرة الدائرية أو المربعة المحمية بنعومة */
        .card-icon { 
            font-size: 14px; 
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: white;
        }
        .icon-students { background-color: #0f46bd; }
        .icon-teachers { background-color: #00875a; }
        .icon-subjects { background-color: #b86b00; }
        .icon-grades   { background-color: #5322bd; }
        .icon-users    { background-color: #ab1254; }

        .card p { font-size: 13px; color: #334155; line-height: 1.6; text-align: right; margin-bottom: 8px; font-weight: 500; }
        
        /* 4. سر اللمعة الذهبية والكريستالية: تدرج أفقي + طبقة إضاءة علوية بيضاء (inset shadow) */
        .card a { 
            text-decoration: none; 
            text-align: center; 
            padding: 11px; 
            border-radius: 6px; 
            font-size: 13px; 
            font-weight: bold; 
            display: block; 
            color: white;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.35); /* خط علوي مشع للزر */
            /* تأثير اللمعة وانعكاس الضوء الكريستالي داخل الزر */
            box-shadow: inset 0 12px 12px rgba(255, 255, 255, 0.25), 0 4px 12px rgba(0, 0, 0, 0.08); 
            transition: all 0.2s ease;
        }
        
        /* زر الطلاب: أزرق ملكي متدرج أفقياً ويلمع */
        .btn-students { background: linear-gradient(to left, #0f46bd 0%, #3b82f6 100%); }
        .btn-students:hover { background: linear-gradient(to left, #0c3da5 0%, #2563eb 100%); }
        
        /* زر المعلمين: أخضر زمردي غني متدرج أفقياً ويلمع */
        .btn-teachers { background: linear-gradient(to left, #00875a 0%, #10b981 100%); }
        .btn-teachers:hover { background: linear-gradient(to left, #006c48 0%, #059669 100%); }
        
        /* زر المواد: التدرج الذهبي النحاسي الفخم والأصلي جداً من يمين ليسار مع اللمعة */
        .btn-subjects { background: linear-gradient(to left, #b86b00 0%, #f59e0b 100%); }
        .btn-subjects:hover { background: linear-gradient(to left, #965700 0%, #d97706 100%); }
        
        /* زر الدرجات: بنفسجي ملكي ساحر متدرج أفقياً ويلمع */
        .btn-grades { background: linear-gradient(to left, #5322bd 0%, #8b5cf6 100%); }
        .btn-grades:hover { background: linear-gradient(to left, #431a9c 0%, #7c3aed 100%); }
        
        /* زر المستخدمين: وردي توتي دافئ متدرج أفقياً ويلمع */
        .btn-users { background: linear-gradient(to left, #ab1254 0%, #ec4899 100%); }
        .btn-users:hover { background: linear-gradient(to left, #8c0e44 0%, #db2777 100%); }

        /* الفوتر */
        .simple-footer { 
            background: #ffffff; 
            color: #475569; 
            text-align: center; 
            padding: 20px; 
            font-size: 12px; 
            border-top: 1px solid #e2e8f0;
            line-height: 1.8;
            margin-top: auto;
        }
        .simple-footer a { color: #0f46bd; text-decoration: none; font-weight: bold; }
        .simple-footer a:hover { text-decoration: underline; }

        @media (max-width: 992px) {
            .sidebar { width: 70px; }
            .sidebar-brand span, .sidebar-menu span { display: none; }
            .main-content { margin-right: 70px; }
            header { padding: 15px 20px; }
            .container { padding: 20px; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-layer-group"></i> <span>لوحة تحكم النظام</span>
        </div>
        <div class="sidebar-menu">
            <a href="index.php" class="active"><i class="fa-solid fa-house"></i> <span>الرئيسية</span></a>
            <a href="students.php"><i class="fa-solid fa-graduation-cap"></i> <span>شؤون الطلاب</span></a>
            <a href="teachers.php"><i class="fa-solid fa-chalkboard-user"></i> <span>كادر المعلمين</span></a>
            <a href="subjects.php"><i class="fa-solid fa-book-open"></i> <span>المواد الدراسية</span></a>
            <a href="grades.php"><i class="fa-solid fa-chart-simple"></i> <span>رصد الدرجات</span></a>
            <a href="users.php"><i class="fa-solid fa-user-shield"></i> <span>إدارة الحسابات</span></a>
            
            <a href="logout.php" class="btn-logout"><i class="fa-solid fa-door-open"></i> تسجيل الخروج</a>
        </div>
    </div>

    <div class="main-content">
        
        <header>
            <div class="header-main">
                <h1>School Management System</h1>
                <p>مرحباً بكِ في لوحة التحكم الإدارية المتكاملة</p>
            </div>
        </header>

        <div class="container">
            <div class="grid-layout">
                
                <div class="card card-students">
                    <div class="card-header-box">
                        <h3>Students</h3>
                        <div class="card-icon icon-students"><i class="fa-solid fa-graduation-cap"></i></div>
                    </div>
                    <p>إعادة ضبط وإدارة ملفات الطلاب، إضافة سجلات جديدة، والتعديل أو الحذف السريع للبيانات الحالية.</p>
                    <a href="students.php" class="btn-students">Manage</a>
                </div>

                <div class="card card-teachers">
                    <div class="card-header-box">
                        <h3>Teachers</h3>
                        <div class="card-icon icon-teachers"><i class="fa-solid fa-briefcase"></i></div>
                    </div>
                    <p>تسجيل المدرسين الجدد، تحديث التخصصات التدريسية والمحافظة على دقة سجلات الهواتف والبريد.</p>
                    <a href="teachers.php" class="btn-teachers">Manage</a>
                </div>

                <div class="card card-subjects">
                    <div class="card-header-box">
                        <h3>Subjects</h3>
                        <div class="card-icon icon-subjects"><i class="fa-solid fa-book-open"></i></div>
                    </div>
                    <p>إدخال المقررات والمساقات التعليمية، ضبط أرقام الأكواد، وتنسيق ربط المواد بأساتذتها.</p>
                    <a href="subjects.php" class="btn-subjects">Manage</a>
                </div>

                <div class="card card-grades">
                    <div class="card-header-box">
                        <h3>Grades</h3>
                        <div class="card-icon icon-grades"><i class="fa-solid fa-chart-line"></i></div>
                    </div>
                    <p>رصد ومتابعة علامات الطلاب، وضمان مطابقتها للمعرفات الحقيقية والتحكم بالسجلات بسلاسة.</p>
                    <a href="grades.php" class="btn-grades">Manage</a>
                </div>

                <div class="card card-users">
                    <div class="card-header-box">
                        <h3>Users</h3>
                        <div class="card-icon icon-users"><i class="fa-solid fa-shield-halved"></i></div>
                    </div>
                    <p>التحكم بحسابات المسؤولين (Admins)، تعديل الصلاحيات، وضمان تشفير كلمات المرور بالموقع.</p>
                    <a href="users.php" class="btn-users">Manage</a>
                </div>

            </div>
        </div>

        <footer class="simple-footer">
            <div>نظام إدارة المدرسة المطور © ٢٠٢٦</div>
            <div>للتواصل والدعم الفني عبر البريد الإلكتروني: 
                <a href="mailto:nouralzaqzooq@gmail.com">nouralzaqzooq@gmail.com</a> | 
                <a href="mailto:noorissa@gmail.com">noorissa@gmail.com</a>
            </div>
        </footer>

    </div>

</body>
</html>
