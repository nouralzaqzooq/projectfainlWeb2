<?php
include "db.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM subjects WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $subject_name = $row["subject_name"];
    $subject_code = $row["subject_code"];
    $teacher_id = $row["teacher_id"];
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المادة الدراسية - School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { 
            background-color: #f3f7fa; 
            min-height: 100vh; 
            display: flex; 
            overflow-x: hidden;
        }

        /* 1. القائمة الجانبية الثابتة والموحدة للموقع بالتدرج الكحلي والأزرق */
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

        .sidebar-menu { list-style: none; display: flex; flex-direction: column; gap: 2px; }

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
            padding: 35px;
        }

        .page-title {
            font-size: 22px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* 3. صندوق وفورم التعديل الكريستالي الفخم */
        .card-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            max-width: 600px; /* حجم مريح ومثالي لعناصر التعديل */
            width: 100%;
        }

        .card-form h3 {
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 25px;
            font-weight: 700;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 10px;
        }

        .form-flex {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 13px;
            color: #475569;
            font-weight: 600;
        }

        .form-group input {
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            color: #334155;
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }

        .form-group input:focus {
            border-color: #ea580c; /* تركيز بلون برتقالي ناري مخصص للقسم */
        }

        /* مجموعة أزرار التحكم السفلية */
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        /* زر التحديث اللامع باللون البرتقالي الدافئ */
        .btn-update {
            background: linear-gradient(to left, #c2410c 0%, #f97316 100%);
            color: white;
            border: none;
            padding: 11px 24px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: bold;
            cursor: pointer;
            border-top: 1px solid rgba(255, 255, 255, 0.35);
            /* تأثير اللمعة الكريستالية الكثيفة والظلال */
            box-shadow: inset 0 12px 12px rgba(255, 255, 255, 0.25), 0 4px 12px rgba(194, 65, 12, 0.2);
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-update:hover { background: linear-gradient(to left, #a0330a 0%, #ea580c 100%); }

        /* زر إلغاء التعديل والرجوع إلى جدول المواد الدراسي */
        .btn-cancel {
            background: #f1f5f9;
            color: #475569;
            text-decoration: none;
            padding: 11px 24px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: bold;
            text-align: center;
            transition: background 0.2s;
            border: 1px solid #e2e8f0;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-cancel:hover { background: #e2e8f0; }

        @media (max-width: 992px) {
            .sidebar { width: 70px; }
            .sidebar-brand span, .sidebar-menu span { display: none; }
            .main-content { margin-right: 70px; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-layer-group"></i> <span>لوحة تحكم النظام</span>
        </div>
        <div class="sidebar-menu">
            <a href="index.php"><i class="fa-solid fa-house"></i> <span>الرئيسية</span></a>
            <a href="students.php"><i class="fa-solid fa-graduation-cap"></i> <span>شؤون الطلاب</span></a>
            <a href="teachers.php"><i class="fa-solid fa-chalkboard-user"></i> <span>كادر المعلمين</span></a>
            <a href="subjects.php" class="active"><i class="fa-solid fa-book-open"></i> <span>المواد الدراسية</span></a>
            <a href="grades.php"><i class="fa-solid fa-chart-simple"></i> <span>رصد الدرجات</span></a>
            <a href="users.php"><i class="fa-solid fa-user-shield"></i> <span>إدارة الحسابات</span></a>
            
            <a href="logout.php" class="btn-logout"><i class="fa-solid fa-door-open"></i> تسجيل الخروج</a>
        </div>
    </div>

    <div class="main-content">
        
        <div class="page-title">
            <i class="fa-solid fa-book-bookmark" style="color: #f97316;"></i>
            <span>تعديل بيانات المادة الدراسية</span>
        </div>

        <div class="card-form">
            <h3><i class="fa-solid fa-sliders"></i> تعديل المادة الحالية (ID: <?php echo $id; ?>)</h3>
            
            <form action="updateSubject.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <div class="form-flex">
                    
                    <div class="form-group">
                        <label>اسم المادة الدراسية (Subject Name):</label>
                        <input type="text" name="subject_name" value="<?php echo $subject_name; ?>" required placeholder="أدخل اسم المادة المعدل">
                    </div>

                    <div class="form-group">
                        <label>كود ترميز المادة (Subject Code):</label>
                        <input type="text" name="subject_code" value="<?php echo $subject_code; ?>" required placeholder="مثال: CS-101">
                    </div>

                    <div class="form-group">
                        <label>معرّف الأستاذ المدرس (Teacher ID):</label>
                        <input type="number" name="teacher_id" value="<?php echo $teacher_id; ?>" required placeholder="رقم ID الأستاذ الجديد">
                    </div>

                    <div class="btn-group">
                        <button type="submit" name="update" class="btn-update">
                            <i class="fa-solid fa-floppy-disk"></i> حفظ التغييرات
                        </button>
                        <a href="subjects.php" class="btn-cancel">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> إلغاء العودة
                        </a>
                    </div>
                    
                </div>
            </form>
        </div>

    </div>

</body>
</html>
