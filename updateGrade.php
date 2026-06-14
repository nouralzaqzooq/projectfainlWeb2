<?php
include "db.php";

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $grade = $_POST['grade'];

    $sql = "UPDATE grades SET 
            student_id='$student_id', 
            subject_id='$subject_id', 
            grade='$grade' 
            WHERE id='$id'";

    if(mysqli_query($conn, $sql)){
        header("Location: grades.php?msg=Grade Updated Successfully");
        exit();
    } else {
        header("Location: grades.php?msg=Error Updating Grade");
        exit();
    }
}
?>
