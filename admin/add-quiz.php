<?php

include '../config/db.php';

$message = "";

$courses = mysqli_query($conn, "SELECT * FROM courses");

if(isset($_POST['save']))
{
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $time_limit = $_POST['time_limit'];

    $sql = "INSERT INTO quizzes(course_id,title,time_limit)
            VALUES('$course_id','$title','$time_limit')";

    if(mysqli_query($conn,$sql))
    {
        $message = "Quiz Added Successfully!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Add Quiz</h2>

<div class="alert alert-success">
<?php echo $message; ?>
</div>

<form method="POST">

<div class="mb-3">
<label>Course</label>

<select name="course_id" class="form-control">

<?php while($course=mysqli_fetch_assoc($courses)){ ?>

<option value="<?php echo $course['id']; ?>">
<?php echo $course['title']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="mb-3">
<label>Quiz Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>Time Limit (Minutes)</label>
<input type="number" name="time_limit" class="form-control" required>
</div>

<button type="submit" name="save" class="btn btn-primary">
Save Quiz
</button>

</form>

</div>

</body>
</html>