<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "mathmaster_lk"
);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>