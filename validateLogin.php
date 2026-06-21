<?php
session_start(); 
include 'db.php';

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        header("Location: login.php?error=Email is empty");
        exit();
    }
    if(empty($password)){
        header("Location: login.php?error=password is empty");
        exit();
    }

    // التعديل الآمن يبدأ هنا 🛡️
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows === 1){
        $row = $result->fetch_assoc();
        // التعديل الآمن ينتهي هنا
        
        // فحص الباسورد المشفر
        if(password_verify($password, $row["password"])){
            $_SESSION['name'] = $row["name"];
            $_SESSION['role'] = $row["role"];
            $_SESSION['id'] = $row["id"];
            $_SESSION['user'] = $row["email"]; // السطر المهم ليتعرف عليه بقية المشروع
            $_SESSION['logged'] = TRUE;
            
            // تعديل: تحويل المستخدم إلى الصفحة الرئيسية للمشروع بدلاً من البروفايل
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
