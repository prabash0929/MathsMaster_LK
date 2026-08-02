<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$quiz_id = $_GET['id'];

$questions = mysqli_query($conn,"SELECT * FROM questions WHERE quiz_id='$quiz_id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Attempt Quiz</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Attempt Quiz</h2>

<form method="POST" action="submit-quiz.php">

<input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">

<?php while($q=mysqli_fetch_assoc($questions)) { ?>

<div class="card mb-3 p-3">

<p><b><?php echo $q['question']; ?></b></p>

<input type="radio" name="answer[<?php echo $q['id']; ?>]" value="A"> <?php echo $q['option_a']; ?><br>
<input type="radio" name="answer[<?php echo $q['id']; ?>]" value="B"> <?php echo $q['option_b']; ?><br>
<input type="radio" name="answer[<?php echo $q['id']; ?>]" value="C"> <?php echo $q['option_c']; ?><br>
<input type="radio" name="answer[<?php echo $q['id']; ?>]" value="D"> <?php echo $q['option_d']; ?><br>

</div>

<?php } ?>

<button type="submit" class="btn btn-success">
Submit Quiz
</button>

</form>

</div>

</body>
</html>