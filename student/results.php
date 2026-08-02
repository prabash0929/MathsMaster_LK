<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"
SELECT results.*, quizzes.title
FROM results
JOIN quizzes ON results.quiz_id = quizzes.id
WHERE student_id='$user_id'
");

?>

<!DOCTYPE html>
<html>
<head>
<title>My Results</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>My Quiz Results</h2>

<table class="table table-bordered">

<tr>
<th>Quiz</th>
<th>Score</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['score']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>