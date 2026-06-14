<?php
include "db.php";

if(isset($_POST['add'])){

    $teacher_name = $_POST['teacher_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO teachers(teacher_name,specialization,phone,email)
            VALUES('$teacher_name','$specialization','$phone','$email')";

    mysqli_query($conn,$sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teachers Management</title>
</head>
<body>

<h2>Add Teacher</h2>

<form method="post">

    Teacher Name:
    <input type="text" name="teacher_name" required><br><br>

    Specialization:
    <input type="text" name="specialization" required><br><br>

    Phone:
    <input type="text" name="phone" required><br><br>

    Email:
    <input type="email" name="email" required><br><br>

    <input type="submit" name="add" value="Add Teacher">

</form>

<hr>

<h2>Teachers List</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Name</th>
    <th>Specialization</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Delete</th>
    <th>Edit</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM teachers");
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['teacher_name']; ?></td>
    <td><?php echo $row['specialization']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <!-- روابط العمليات بناءً على اسم المعلم لتطابق جدولك الحالي -->
    <td><a href="deleteTeacher.php?teacher_name=<?= $row['teacher_name']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
    <td><a href="editTeacher.php?teacher_name=<?= $row['teacher_name']; ?>">Edit</a></td>
</tr>

<?php } ?>

</table>
