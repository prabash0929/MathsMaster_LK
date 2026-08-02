<?php

include '../config/db.php';

$message = "";

$courses = mysqli_query($conn, "SELECT * FROM courses");

if(isset($_POST['save']))
{
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $video_url = $_POST['video_url'];

    $sql = "INSERT INTO lessons(course_id,title,video_url)
            VALUES('$course_id','$title','$video_url')";

    if(mysqli_query($conn,$sql))
    {
        $message = "Lesson Added Successfully!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Lesson</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Add Lesson</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<div class="mb-3">
<label>Course</label>

<select name="course_id" class="form-control" required>

<?php while($course = mysqli_fetch_assoc($courses)) { ?>

<option value="<?php echo $course['id']; ?>">
<?php echo $course['title']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="mb-3">
<label>Lesson Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>YouTube Video URL</label>
<input type="text" name="video_url" class="form-control" required>
</div>

<button type="submit" name="save" class="btn btn-primary">
Save Lesson
</button>

</form>

</div>

</body>
</html>