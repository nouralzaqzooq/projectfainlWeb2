<?php
include "db.php";

if(isset($_POST['update'])){
    // استقبال الـ id الفريد للمادة
    $id = $_POST['id'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $teacher_id = $_POST['teacher_id'];

    // التحديث بناءً على الـ id لضمان تعديل السطر المطلوب بالظبط
    $sql = "UPDATE subjects SET 
            subject_name='$subject_name', 
            subject_code='$subject_code', 
            teacher_id='$teacher_id' 
            WHERE id='$id'";

    if(mysqli_query($conn, $sql)){
        header("Location: subjects.php?msg=Subject Updated Successfully");
        exit();
    } else {
        header("Location: subjects.php?msg=Error Updating Subject");
        exit();
    }
}
?>

