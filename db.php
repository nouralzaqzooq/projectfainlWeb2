<?php
$conn = new mysqli("localhost", "root", "", "school_management");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>