<?php

include '../config/db.php';

$message = "";

if(isset($_POST['save']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO courses(title,description,grade)
            VALUES('$title','$description','$grade')";

    if(mysqli_query($conn,$sql))
    {
        $message = "Course Added Successfully!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Add Course</h2>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <div class="mb-3">
            <label>Course Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Grade</label>
            <select name="grade" class="form-control">
                <option>Grade 10</option>
                <option>Grade 11</option>
            </select>
        </div>

        <button type="submit" name="save" class="btn btn-primary">
            Save Course
        </button>

    </form>

</div>

</body>
</html>