<?php

include '../config/db.php';

$sql = "SELECT lessons.*, courses.title AS course_name
        FROM lessons
        JOIN courses ON lessons.course_id = courses.id";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>Lessons</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>All Lessons</h2>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Course</th>
<th>Lesson</th>
<th>Video URL</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['title']; ?></td>

<td>
<a href="<?php echo $row['video_url']; ?>" target="_blank">
Open Video
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>