<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'];
$quiz_id = $_POST['quiz_id'];

$answers = $_POST['answer'];

$score = 0;

foreach($answers as $question_id => $user_answer)
{
    $result = mysqli_query($conn,"SELECT correct_answer FROM questions WHERE id='$question_id'");
    $row = mysqli_fetch_assoc($result);

    if($row['correct_answer'] == $user_answer)
    {
        $score++;
    }
}

// Save result
mysqli_query($conn,"
INSERT INTO results(student_id,quiz_id,score)
VALUES('$user_id','$quiz_id','$score')
");

?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<div class="alert alert-success">

<h2>Your Score: <?php echo $score; ?></h2>

<a href="quizzes.php" class="btn btn-primary">
Back to Quizzes
</a>

</div>

</div>

</body>
</html>