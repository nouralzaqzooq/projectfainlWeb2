<?php
include "db.php";
require 'auth.php';
require 'adminAuth.php';


if(isset($_POST['add'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users(name, email, password, role)
            VALUES('$name', '$email', '$password', '$role')";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الحسابات - School Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { 
            background-color: #f3f7fa; 
            min-height: 100vh; 
            display: flex; 
            overflow-x: hidden;
        }

        /* 1. القائمة الجانبية الثابتة بالتدرج الكحلي والأزرق الموحد للموقع */
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

        /* 3. تنسيق الصندوق والفورم (Add User) */
        .card-form {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            margin-bottom: 35px;
        }

        .card-form h3 {
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            align-items: end;
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
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 13.5px;
            color: #334155;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #ec4899; /* التركيز باللون الوردي */
        }

        /* زر الإضافة الكريستالي اللامع باللون الوردي التوتي المشرق */
        .btn-add {
            background: linear-gradient(to left, #ab1254 0%, #ec4899 100%);
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: bold;
            cursor: pointer;
            border-top: 1px solid rgba(255, 255, 255, 0.35);
            /* تأثير اللمعة والظلال الخاصة بالقسم */
            box-shadow: inset 0 12px 12px rgba(255, 255, 255, 0.25), 0 4px 12px rgba(171, 18, 84, 0.25);
            transition: all 0.2s;
            height: 41px;
        }
        .btn-add:hover { background: linear-gradient(to left, #8c0e44 0%, #db2777 100%); }

        /* 4. تنسيق جدول المستخدمين */
        .table-container {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .table-container h3 {
            padding: 20px 25px;
            font-size: 16px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        /* الهيدر يأخذ التدرج الوردي الفخم اللامع */
        th {
            background: linear-gradient(to left, #ab1254 0%, #ec4899 100%);
            color: white;
            font-size: 13.5px;
            font-weight: 600;
            padding: 14px 20px;
        }

        td {
            padding: 14px 20px;
            font-size: 13.5px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }

        /* شارات الأدوار المتناسقة داخل الجدول */
        .badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-admin { background: #fce8f3; color: #ab1254; }
        .badge-user { background: #f1f5f9; color: #475569; }

        /* أزرار العمليات الكريستالية اللامعة داخل الجدول */
        .btn-table {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white !important;
            display: inline-block;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: inset 0 8px 8px rgba(255, 255, 255, 0.2);
        }
        
        .btn-edit { background: linear-gradient(to left, #ab1254 0%, #ec4899 100%); }
        .btn-edit:hover { background: #8c0e44; }

        .btn-delete { background: linear-gradient(to left, #b91c1c 0%, #ef4444 100%); }
        .btn-delete:hover { background: #961515; }

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
            <a href="subjects.php"><i class="fa-solid fa-book-open"></i> <span>المواد الدراسية</span></a>
            <a href="grades.php"><i class="fa-solid fa-chart-simple"></i> <span>رصد الدرجات</span></a>
            <a href="users.php" class="active"><i class="fa-solid fa-user-shield"></i> <span>إدارة الحسابات</span></a>
            
            <a href="logout.php" class="btn-logout"><i class="fa-solid fa-door-open"></i> تسجيل الخروج</a>
        </div>
    </div>

    <div class="main-content">
        
        <div class="page-title">
            <i class="fa-solid fa-user-shield" style="color: #ab1254;"></i>
            <span>إدارة حسابات النظام (Users)</span>
        </div>

        <div class="card-form">
            <h3><i class="fa-solid fa-user-plus"></i> إضافة حساب مستخدم أو مدير جديد</h3>
            <form method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label>الاسم الكامل (Name):</label>
                        <input type="text" name="name" required placeholder="أدخل اسم الحساب">
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكتروني (Email):</label>
                        <input type="email" name="email" required placeholder="example@system.com">
                    </div>

                    <div class="form-group">
                        <label>كلمة المرور (Password):</label>
                        <input type="password" name="password" required placeholder="••••••••">
                    </div>

                    <div class="form-group">
                        <label>الصلاحية والمسؤولية (Role):</label>
                        <select name="role">
                            <option value="1">مسؤول النظام (Admin)</option>
                            <option value="0">مستخدم عادي (User)</option>
                        </select>
                    </div>

                    <button type="submit" name="add" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Add User
                    </button>
                </div>
            </form>
        </div>

        <div class="table-container">
            <h3><i class="fa-solid fa-users-gear"></i> الحسابات المسجلة وصلاحياتها الحالية</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM users");
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><strong><?php echo $row['id']; ?></strong></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <?php if($row['role'] == 1): ?>
                                <span class="badge badge-admin"><i class="fa-solid fa-user-crown"></i> Admin</span>
                            <?php else: ?>
                                <span class="badge badge-user"><i class="fa-solid fa-user"></i> User</span>
                            <?php endif; ?>
                        </td>
                        
                        <td>
                            <a href="editUser.php?id=<?php echo $row['id']; ?>" class="btn-table btn-edit">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                        </td>
                        <td>
                            <a href="deleteUser.php?id=<?php echo $row['id']; ?>" class="btn-table btn-delete" onclick="return confirm('Are you sure you want to delete this user account?')">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
