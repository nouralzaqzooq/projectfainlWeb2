<?php
include "db.php";

if(isset($_POST['update'])){
    $old_name = $_POST['old_name']; // الاسم قبل التعديل
    $student_name = $_POST['student_name']; // الاسم الجديد
    $gender = $_POST['gender'];
    $level = $_POST['level'];
    $major = $_POST['major'];
    $phone = $_POST['phone'];

    // استعلام التحديث بناءً على الاسم القديم المخفي
    $sql = "UPDATE students SET 
            student_name='$student_name', 
            gender='$gender', 
            level='$level', 
            major='$major', 
            phone='$phone' 
            WHERE student_name='$old_name'";

    if(mysqli_query($conn, $sql)){
        header("Location: students.php?msg=Student Updated Successfully");
        exit();
    } else {
        header("Location: students.php?msg=Error Updating Student");
        exit();
    }
}
?>
