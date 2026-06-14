<?php
include "db.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    $sql = "DELETE FROM users WHERE id = '$id'";

    
    if(mysqli_query($conn, $sql)){
        header("Location: users.php?msg=User Deleted Successfully");
        exit();
    } else {
        header("Location: users.php?msg=Error Deleting User");
        exit();
    }
}
header("Location: users.php");
exit();

?>
