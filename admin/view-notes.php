<?php

include '../config/db.php';

$result = mysqli_query($conn,"
SELECT notes.*, courses.title AS course_name
FROM notes
JOIN courses ON notes.course_id = courses.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Notes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>All Notes</h2>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Course</th>
<th>Title</th>
<th>PDF</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['title']; ?></td>

<td>
<a target="_blank"
href="../uploads/notes/<?php echo $row['file_name']; ?>">
Open PDF
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>