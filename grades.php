<?php
include "db.php";

if(isset($_POST['add'])){

    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO grades(student_id, subject_id, grade)
            VALUES('$student_id', '$subject_id', '$grade')";

    mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Grades Management</title>
</head>
<body>

<h2>Add Grade</h2>

<form method="post">

    Student ID:
    <input type="number" name="student_id" required><br><br>

    Subject ID:
    <input type="number" name="subject_id" required><br><br>

    Grade:
    <input type="number" step="0.01" name="grade" required><br><br>

    <input type="submit" name="add" value="Add Grade">

</form>

<hr>

<h2>Grades List</h2>

<table border="1" cellpadding="10">

<!-- عناوين الجدول الرئيسية شاملة الحذف والتعديل -->
<tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>Subject ID</th>
    <th>Grade</th>
    <th>Delete</th>
    <th>Edit</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM grades");
while($row = mysqli_fetch_assoc($result)){
?>

<!-- عرض البيانات الفعلية للدرجات داخل الجدول -->
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['student_id']; ?></td>
    <td><?php echo $row['subject_id']; ?></td>
    <td><?php echo $row['grade']; ?></td>
    <!-- أزرار الحذف والتعديل الملونة والذكية معتمدة على الـ ID -->
    <td><a href="deleteGrade.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" style="color: red; font-weight: bold;">Delete</a></td>
    <td><a href="editGrade.php?id=<?php echo $row['id']; ?>" style="color: blue; font-weight: bold;">Edit</a></td>
</tr>

<?php } ?>

</table>

</body>
</html>
