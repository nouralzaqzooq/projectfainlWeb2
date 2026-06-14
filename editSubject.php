<?php
include "db.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM subjects WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $subject_name = $row["subject_name"];
    $subject_code = $row["subject_code"];
    $teacher_id = $row["teacher_id"];
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit Subject</title>
</head>
<body>

<h2>Edit Subject Data</h2>

<form action="updateSubject.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">


    Subject Name:
    <input type="text" name="subject_name" value="<?php echo $subject_name; ?>" required><br><br>

    Subject Code:
    <input type="text" name="subject_code" value="<?php echo $subject_code; ?>" required><br><br>

    Teacher ID:
    <input type="number" name="teacher_id" value="<?php echo $teacher_id; ?>" required><br><br>

    <input type="submit" name="update" value="Update Subject">
</form>

</body>
</html>
