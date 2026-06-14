<?php
include "db.php";

// استقبال الاسم القادم من رابط جدول المعلمين
if(isset($_GET["teacher_name"])){
    $old_name = $_GET["teacher_name"];
    
    // جلب بيانات المعلم بناءً على الاسم
    $sql = "SELECT * FROM teachers WHERE teacher_name = '$old_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // تعبئة المتغيرات لعرضها داخل مربعات النص
    $teacher_name = $row["teacher_name"];
    $specialization = $row["specialization"];
    $phone = $row["phone"];
    $email = $row["email"];
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>
</head>
<body>

<h2>Edit Teacher Data</h2>

<form action="updateTeacher.php" method="post">
    <!-- حقل مخفي لحفظ الاسم القديم كشرط للتعديل بالخلفية -->
    <input type="hidden" name="old_name" value="<?php echo $old_name; ?>">



    Teacher Name:
    <input type="text" name="teacher_name" value="<?php echo $teacher_name; ?>" required><br><br>

    Specialization:
    <input type="text" name="specialization" value="<?php echo $specialization; ?>" required><br><br>

    Phone:
    <input type="text" name="phone" value="<?php echo $phone; ?>" required><br><br>

    Email:
    <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <input type="submit" name="update" value="Update Teacher">
</form>

</body>
</html>
