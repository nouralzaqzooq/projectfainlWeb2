<?php
include "db.php";
require 'auth.php';

?>

<!DOCTYPE html>
<html>
    
<head>
    <title>School Management System</title>
    <style>
        body{
            font-family: Arial;
            background:#f4f4f4;
            text-align:center;
        }

        .container{
            width:80%;
            margin:auto;
            margin-top:50px;
        }

        .card{
            display:inline-block;
            width:220px;
            padding:20px;
            margin:10px;
            background:white;
            border-radius:10px;
            box-shadow:0 0 10px #ccc;
        }

        a{
            text-decoration:none;
            color:white;
            background:#007bff;
            padding:10px 15px;
            border-radius:5px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>School Management System</h1>

    <div class="card">
        <h3>Students</h3>
        <p>Add, Edit, Delete Students</p>
        <a href="students.php">Manage</a>
    </div>

    <div class="card">
        <h3>Teachers</h3>
        <p>Add, Edit, Delete Teachers</p>
        <a href="teachers.php">Manage</a>
    </div>

    <div class="card">
        <h3>Subjects</h3>
        <p>Add, Edit, Delete Subjects</p>
        <a href="subjects.php">Manage</a>
    </div>

    <div class="card">
        <h3>Grades</h3>
        <p>Add, Edit, Delete Grades</p>
        <a href="grades.php">Manage</a>
    </div>

    <div class="card">
        <h3>Users</h3>
        <p>Add, Edit, Delete Users</p>
        <a href="users.php">Manage</a>
    </div>

</div>

</body>
</html>