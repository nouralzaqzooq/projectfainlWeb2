<?php
include "db.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    $sql = "DELETE FROM grades WHERE id = '$id'";
    
    if(mysqli_query($conn, $sql)){
        header("Location: grades.php?msg=Grade Deleted Successfully");
        exit();
    } else {
        header("Location: grades.php?msg=Error Deleting Grade");
        exit();
    }
}
?>
