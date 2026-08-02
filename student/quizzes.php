<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn,"
SELECT quizzes.*, courses.title AS course_name
FROM quizzes
JOIN courses ON quizzes.course_id = courses.id
");

?>

<!DOCTYPE html>
<html>
<head>
<title>Quizzes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Available Quizzes</h2>

<table class="table table-bordered">

<tr>
<th>Course</th>
<th>Quiz</th>
<th>Time</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $row['course_name']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['time_limit']; ?> min</td>
<td>
<a href="attempt-quiz.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
Start Quiz
</a>
</td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>