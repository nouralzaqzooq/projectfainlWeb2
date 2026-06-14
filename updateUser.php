<?php
include "db.php";

if(isset($_POST['update'])){
    // استقبال الـ id المرسل من الحقل المخفي في صفحة التعديل
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // التحديث بناءً على الـ id لضمان تعديل السطر المطلوب بالظبط
    $password = $_POST['password'];

// وإذا أردتِ تشفيره ليتطابق مع الـ signup الآمن:
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET 
            name='$name', 
            email='$email', 
            password='$hashed_password', 
            role='$role' 
            WHERE id='$id'";


    if(mysqli_query($conn, $sql)){
        // التحويل التلقائي لجدول المستخدمين بعد نجاح التعديل
        header("Location: users.php?msg=User Updated Successfully");
        exit();
    } else {
        echo "خطأ في التعديل: " . mysqli_error($conn);
    }
}
?>
