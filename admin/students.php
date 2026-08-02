<?php

session_start();
include '../config/db.php';

$students = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE role='student'"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Students</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>👥 Students</h2>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
</tr>

<?php while($s=mysqli_fetch_assoc($students)){ ?>

<tr>

<td><?php echo $s['id']; ?></td>
<td><?php echo $s['name']; ?></td>
<td><?php echo $s['email']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>