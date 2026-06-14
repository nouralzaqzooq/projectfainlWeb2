<?php
include "db.php";

if(isset($_POST['add'])){

    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $teacher_id = $_POST['teacher_id'];

    $sql = "INSERT INTO subjects(subject_name, subject_code, teacher_id)
            VALUES('$subject_name', '$subject_code', '$teacher_id')";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subjects Management</title>
</head>
<body>

<h2>Add Subject</h2>

<form method="post">

    Subject Name:
    <input type="text" name="subject_name" required><br><br>

    Subject Code:
    <input type="text" name="subject_code" required><br><br>

    Teacher ID:
    <input type="number" name="teacher_id" required><br><br>

    <input type="submit" name="add" value="Add Subject">

</form>

<hr>

<h2>Subjects List</h2>

<table border="1" cellpadding="10">

<!-- عناوين الجدول الرئيسية شاملة الحذف والتعديل -->
<tr>
    <th>ID</th>
    <th>Subject Name</th>
    <th>Subject Code</th>
    <th>Teacher ID</th>
    <th>Delete</th>
    <th>Edit</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM subjects");
while($row = mysqli_fetch_assoc($result)){
?>

<!-- عرض البيانات الفعلية للمواد داخل الجدول -->
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['subject_name']; ?></td>
    <td><?php echo $row['subject_code']; ?></td>
    <td><?php echo $row['teacher_id']; ?></td>
    <!-- أزرار الحذف والتعديل الملونة والذكية -->
    <td><a href="deleteSubject.php?subject_name=<?php echo $row['subject_name']; ?>" onclick="return confirm('Are you sure?')" style="color: red; font-weight: bold;">Delete</a></td>
    <td><a href="editSubject.php?id=<?php echo $row['id']; ?>" style="color: blue; font-weight: bold;">Edit</a></td>
</tr>

<?php } ?>

</table>

</body>
</html>
