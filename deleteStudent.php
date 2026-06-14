<?php
include "db.php";

if(isset($_GET["student_name"])){
    $student_name = $_GET["student_name"];
    
    // استعلام الحذف بناءً على اسم الطالب
    $sql = "DELETE FROM students WHERE student_name = '$student_name'";
    
    if(mysqli_query($conn, $sql)){
        header("Location: students.php?msg=Student Deleted Successfully");
        exit();
    } else {
        header("Location: students.php?msg=Error Deleting Student");
        exit();
    }
}
?>
