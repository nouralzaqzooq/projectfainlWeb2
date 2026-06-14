<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// إذا كان المستخدم مسجل دخول ولكن ليس أدمن (role لا يساوي 1) يتم طرده للرئيسية
if(isset($_SESSION['role']) && $_SESSION['role'] != 1){
    header("Location: index.php?error=Access Denied");
    exit();
}
?>
