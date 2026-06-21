<?php
include "db.php";

// استقبال الاسم الحالي للطالب لجلب بياناته
if(isset($_GET["student_name"])){
    $old_name = $_GET["student_name"];
    
    $sql = "SELECT * FROM students WHERE student_name = '$old_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // جلب البيانات لوضعها داخل الحقول
    $student_name = $row["student_name"];
    $gender = $row["gender"];
    $level = $row["level"];
    $major = $row["major"];
    $phone = $row["phone"];
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات الطالب - School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { 
            background-color: #f3f7fa; 
            min-height: 100vh; 
            display: flex; 
            overflow-x: hidden;
        }

        /* 1. القائمة الجانبية الثابتة والموحدة للموقع بالتدرج الكحلي */
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

        /* 3. صندوق وفورم التعديل الفخم بمنتصف الصفحة */
        .card-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            max-width: 600px; /* عرض متناسق ومريح للعين */
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

        .form-group input, .form-group select {
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            color: #334155;
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #1d4ed8; /* تركيز باللون الأزرق المخصص للطلاب */
        }

        /* مجموعة أزرار التحكم السفلى */
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        /* زر حفظ التعديل الكريستالي باللون الأزرق الكحلي الملكي */
        .btn-update {
            background: linear-gradient(to left, #0b1e47 0%, #1d4ed8 100%);
            color: white;
            border: none;
            padding: 11px 24px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: bold;
            cursor: pointer;
            border-top: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: inset 0 12px 12px rgba(255, 255, 255, 0.2), 0 4px 12px rgba(11, 30, 71, 0.2);
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-update:hover { background: linear-gradient(to left, #06122c 0%, #173ebd 100%); }

        /* زر الإلغاء والرجوع للخلف للجدول الرئيسي */
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
            <a href="students.php" class="active"><i class="fa-solid fa-graduation-cap"></i> <span>شؤون الطلاب</span></a>
            <a href="teachers.php"><i class="fa-solid fa-chalkboard-user"></i> <span>كادر المعلمين</span></a>
            <a href="subjects.php"><i class="fa-solid fa-book-open"></i> <span>المواد الدراسية</span></a>
            <a href="grades.php"><i class="fa-solid fa-chart-simple"></i> <span>رصد الدرجات</span></a>
            <a href="users.php"><i class="fa-solid fa-user-shield"></i> <span>إدارة الحسابات</span></a>
            
            <a href="logout.php" class="btn-logout"><i class="fa-solid fa-door-open"></i> تسجيل الخروج</a>
        </div>
    </div>

    <div class="main-content">
        
        <div class="page-title">
            <i class="fa-solid fa-user-pen" style="color: #1d4ed8;"></i>
            <span>تعديل ملف الطالب الأكاديمي</span>
        </div>

        <div class="card-form">
            <h3><i class="fa-solid fa-id-card"></i> تعديل بيانات الطالب الحالية: (<?php echo $old_name; ?>)</h3>
            
            <form action="updateStudent.php" method="post">
                <input type="hidden" name="old_name" value="<?php echo $old_name; ?>">
                
                <div class="form-flex">
                    
                    <div class="form-group">
                        <label>اسم الطالب (Student Name):</label>
                        <input type="text" name="student_name" value="<?php echo $student_name; ?>" required placeholder="أدخل اسم الطالب المعدل">
                    </div>

                    <div class="form-group">
                        <label>الجنس (Gender):</label>
                        <select name="gender">
                            <option value="Male" <?php if($gender == 'Male') echo 'selected'; ?>>Male (ذكر)</option>
                            <option value="Female" <?php if($gender == 'Female') echo 'selected'; ?>>Female (أنثى)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>المستوى الدراسي (Level):</label>
                        <input type="number" name="level" value="<?php echo $level; ?>" required placeholder="مثال: 1، 2، 3، 4">
                    </div>

                    <div class="form-group">
                        <label>التخصص الأكاديمي (Major):</label>
                        <input type="text" name="major" value="<?php echo $major; ?>" required placeholder="مثال: هندسة برمجيات، تكنولوجيا المعلومات">
                    </div>

                    <div class="form-group">
                        <label>رقم هاتف التواصل (Phone):</label>
                        <input type="text" name="phone" value="<?php echo $phone; ?>" required placeholder="رقم الجوال الفعال">
                    </div>

                    <div class="btn-group">
                        <button type="submit" name="update" class="btn-update">
                            <i class="fa-solid fa-floppy-disk"></i> حفظ التحديثات
                        </button>
                        <a href="students.php" class="btn-cancel">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> إلغاء العودة
                        </a>
                    </div>
                    
                </div>
            </form>
        </div>

    </div>

</body>
</html>
