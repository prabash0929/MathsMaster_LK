<?php

include '../config/db.php';

$message = "";

$quizzes = mysqli_query($conn, "SELECT * FROM quizzes");

if(isset($_POST['save']))
{
    $quiz_id = $_POST['quiz_id'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['correct_answer'];

    $sql = "INSERT INTO questions
    (quiz_id,question,option_a,option_b,option_c,option_d,correct_answer)
    VALUES
    ('$quiz_id','$question','$option_a','$option_b','$option_c','$option_d','$correct_answer')";

    if(mysqli_query($conn,$sql))
    {
        $message = "Question Added Successfully!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Add Question</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2>Add Question</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<div class="mb-3">

<label>Select Quiz</label>

<select name="quiz_id" class="form-control">

<?php while($quiz=mysqli_fetch_assoc($quizzes)){ ?>

<option value="<?php echo $quiz['id']; ?>">
<?php echo $quiz['title']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="mb-3">
<label>Question</label>
<textarea name="question" class="form-control" required></textarea>
</div>

<div class="mb-3">
<label>Option A</label>
<input type="text" name="option_a" class="form-control" required>
</div>

<div class="mb-3">
<label>Option B</label>
<input type="text" name="option_b" class="form-control" required>
</div>

<div class="mb-3">
<label>Option C</label>
<input type="text" name="option_c" class="form-control" required>
</div>

<div class="mb-3">
<label>Option D</label>
<input type="text" name="option_d" class="form-control" required>
</div>

<div class="mb-3">
<label>Correct Answer</label>

<select name="correct_answer" class="form-control">
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
</select>

</div>

<button type="submit" name="save" class="btn btn-success">
Add Question
</button>

</form>

</div>

</body>
</html>