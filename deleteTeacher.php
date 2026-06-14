<?php
include "db.php";

if(isset($_GET["teacher_name"])){
    $teacher_name = $_GET["teacher_name"];
    
    $sql = "DELETE FROM teachers WHERE teacher_name = '$teacher_name'";
    
    if(mysqli_query($conn, $sql)){
        header("Location: teachers.php?msg=Teacher Deleted Successfully");
        exit();
    } else {
        header("Location: teachers.php?msg=Error Deleting Teacher");
        exit();
    }
}
?>
