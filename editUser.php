<?php
include "db.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    // جلب بيانات المستخدم بناءً على الـ id
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // التأكد من أسماء الأعمدة بمطابقة قاعدة البيانات
    $name = $row["name"];
    $email = $row["email"];
    $role = $row["role"];
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User Data</h2>

<form action="updateUser.php" method="post">
    <!-- حقل مخفي لحفظ الإيميل القديم لشرط التحديث بالخلفية -->
   <input type="hidden" name="id" value="<?php echo $id; ?>">

    Name:
    <input type="text" name="name" value="<?php echo $name; ?>" required><br><br>

    Email:
    <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

    Password:
    <input type="password" name="password" value="<?php echo $password; ?>" required><br><br>

    Role:
   <select name="role">
    <option value="1" <?php if($role == 1) echo 'selected'; ?>>Admin</option>
    <option value="0" <?php if($role == 0) echo 'selected'; ?>>User</option>
</select>

    <input type="submit" name="update" value="Update User">
</form>

</body>
</html>
