<?php
include 'db.php';
session_start();

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

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        
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

