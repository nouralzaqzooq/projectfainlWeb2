<?php
include "db.php";
require 'auth.php';
require 'adminAuth.php';


if(isset($_POST['add'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users(name, email, password, role)
            VALUES('$name', '$email', '$password', '$role')";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users Management</title>
</head>
<body>

<h2>Add User</h2>

<form method="post">

    Name:
    <input type="text" name="name" required><br><br>

    Email:
    <input type="email" name="email" required><br><br>

    Password:
    <input type="password" name="password" required><br><br>

    Role:
    <select name="role">
        <option value="1">Admin</option>
        <option value="0">User</option>
    </select><br><br>

    <input type="submit" name="add" value="Add User">

</form>

<hr>

<h2>Users List</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Delete</th>
    <th>Edit</th>
</tr>


<?php

$result = mysqli_query($conn, "SELECT * FROM users");

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <?php
        if($row['role'] == 1){
            echo "Admin";
        } else {
            echo "User";
        }
        ?>
    </td>
    <!-- السطرين الجديدين لصنع الأزرار تلقائياً في الجدول -->
    <td><a href="deleteUser.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" style="color: red; font-weight: bold;">Delete</a></td>
    <td><a href="editUser.php?id=<?php echo $row['id']; ?>" style="color: blue; font-weight: bold;">Edit</a></td>


</tr>


<?php } ?>

</table>

</body>
</html>