<?php
include "db.php";

// استقبال الاسم الحالي للطالب لجلب بياناته
if(isset($_GET["student_name"])){
    $old_name = $_GET["student_name"];
    
    $sql = "SELECT * FROM students WHERE student_name = '$old_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // جلب البيانات لوضعها داخل الحقول
    $student_name = $row["student_name"];
    $gender = $row["gender"];
    $level = $row["level"];
    $major = $row["major"];
    $phone = $row["phone"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student Data</h2>

<form action="updateStudent.php" method="post">
    <!-- حقل مخفي لحفظ الاسم القديم لكي نستخدمه في شرط التعديل بالخلفية -->
    <input type="hidden" name="old_name" value="<?php echo $old_name; ?>">

    Name:
    <input type="text" name="student_name" value="<?php echo $student_name; ?>" required><br><br>

    Gender:
    <select name="gender">
        <option value="Male" <?php if($gender == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if($gender == 'Female') echo 'selected'; ?>>Female</option>
    </select><br><br>

    Level:
    <input type="number" name="level" value="<?php echo $level; ?>" required><br><br>

    Major:
    <input type="text" name="major" value="<?php echo $major; ?>" required><br><br>

    Phone:
    <input type="text" name="phone" value="<?php echo $phone; ?>" required><br><br>

    <input type="submit" name="update" value="Update Student">
</form>

</body>
</html>
