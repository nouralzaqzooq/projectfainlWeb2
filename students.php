<?php
include "db.php";

if(isset($_POST['add'])){
    
    $student_name = $_POST['student_name'];
    $gender = $_POST['gender'];
    $level = $_POST['level'];
    $major = $_POST['major'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO students(student_name,gender,level,major,phone)
            VALUES('$student_name','$gender','$level','$major','$phone')";

    mysqli_query($conn,$sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>

<h2>Add Student</h2>

<form method="post">

    Name:
    <input type="text" name="student_name"><br><br>

    Gender:
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br><br>

    Level:
    <input type="number" name="level"><br><br>

    Major:
    <input type="text" name="major"><br><br>

    Phone:
    <input type="text" name="phone"><br><br>

    <input type="submit" name="add" value="Add Student">

</form>

<hr>

<h2>Students List</h2>

<table border="1" cellpadding="10">

<tr>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Level</th>
    <th>Major</th>
    <th>Phone</th>
    <th>Delete</th>
    <th>Edit</th>
</tr>

</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM students");
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['student_name']; ?></td>
    <td><?= $row['gender']; ?></td>
    <td><?= $row['level']; ?></td>
    <td><?= $row['major']; ?></td>
    <td><?= $row['phone']; ?></td>
    <!-- روابط الحذف والتعديل الممررة بالاسم المفتاحي للشرط -->
    <td><a href="deleteStudent.php?student_name=<?= $row['student_name']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
    <td><a href="editStudent.php?student_name=<?= $row['student_name']; ?>">Edit</a></td>
</tr>

<?php } ?>

</table>
