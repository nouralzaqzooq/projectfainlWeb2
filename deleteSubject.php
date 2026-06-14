<?php
include "db.php";

if(isset($_GET["subject_code"])){
    $subject_code = $_GET["subject_code"];
    
    $sql = "DELETE FROM subjects WHERE subject_code = '$subject_code'";
    
    if(mysqli_query($conn, $sql)){
        header("Location: subjects.php?msg=Subject Deleted Successfully");
        exit();
    } else {
        header("Location: subjects.php?msg=Error Deleting Subject");
        exit();
    }
}
?>
