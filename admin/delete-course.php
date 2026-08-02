<?php

include '../config/db.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM courses WHERE id=$id");

header("Location: view-courses.php");

exit();

?>