<?php
session_start(); 
include 'db.php';

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من الحقول الفارغة
    if(empty($email)){
        header("Location: login.php?error=Email is empty");
        exit();
    }
    if(empty($password)){
        header("Location: login.php?error=password is empty");
        exit();
    }

    // الاستعلام الآمن باستخدام الـ Prepared Statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows === 1){
        $row = $result->fetch_assoc();
        
        // فحص الباسورد المشفر
        if(password_verify($password, $row["password"])){
            // إعداد الجلسة (Session)
            $_SESSION['name'] = $row["name"];
            $_SESSION['role'] = $row["role"];
            $_SESSION['id'] = $row["id"];
            $_SESSION['user'] = $row["email"];
            $_SESSION['logged'] = TRUE;
            
            // --- الإضافة الجديدة (الـ Cookie للترحيب) ---
            // تخزين اسم المستخدم لمدة 30 يوماً
            setcookie("user_name", $row["name"], time() + (86400 * 30), "/"); 
            // -------------------------------------------
            
            // تحويل المستخدم إلى الصفحة الرئيسية
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=not registered");
            exit();
        }
    } else {
        header("Location: login.php?error=not registered");
        exit();
    }
}
?>
