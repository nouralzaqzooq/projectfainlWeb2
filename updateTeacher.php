<?php
include "db.php";

if(issetPOST['update']){
    $old_name = $_POST['old_name'];
    $teacher_name = $_POST['teacher_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE teachers SET 
            teacher_name='$teacher_name', 
            specialization='$specialization', 
            phone='$phone', 
            email='$email' 
            WHERE teacher_name='$old_name'";

    if(mysqli_query($conn, $sql)){
        header("Location: teachers.php?msg=Teacher Updated Successfully");
        exit();
    } else {
        header("Location: teachers.php?msg=Error Updating Teacher");
        exit();
    }
}
?>
