<?php
include "db.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM grades WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $student_id = $row["student_id"];
    $subject_id = $row["subject_id"];
    $grade = $row["grade"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Grade</title>
</head>
<body>

<h2>Edit Grade Data</h2>

<form action="updateGrade.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    Student ID:
    <input type="number" name="student_id" value="<?php echo $student_id; ?>" required><br><br>

    Subject ID:
    <input type="number" name="subject_id" value="<?php echo $subject_id; ?>" required><br><br>

    Grade:
    <input type="number" step="0.01" name="grade" value="<?php echo $grade; ?>" required><br><br>

    <input type="submit" name="update" value="Update Grade">
</form>

</body>
</html>
