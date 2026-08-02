<?php

session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$lesson_id = $_GET['id'];

mysqli_query(
    $conn,
    "INSERT INTO favorites(user_id, lesson_id)
     VALUES('$user_id','$lesson_id')"
);

header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
?>