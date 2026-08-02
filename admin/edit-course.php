<?php

include '../config/db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM courses WHERE id='$id'");
$course = mysqli_fetch_assoc($result);

$message = "";

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $grade = $_POST['grade'];

    $sql = "UPDATE courses
            SET title='$title',
                description='$description',
                grade='$grade'
            WHERE id='$id'";

    if(mysqli_query($conn, $sql))
    {
        header("Location: view-courses.php");
        exit();
    }
    else
    {
        $message = "Update Failed!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h3>Edit Course</h3>
        </div>

        <div class="card-body">

            <p><?php echo $message; ?></p>

            <form method="POST">

                <div class="mb-3">
                    <label>Course Title</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?php echo $course['title']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"><?php echo $course['description']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Grade</label>

                    <select name="grade" class="form-control">

                        <option
                            value="Grade 10"
                            <?php if($course['grade']=="Grade 10") echo "selected"; ?>>
                            Grade 10
                        </option>

                        <option
                            value="Grade 11"
                            <?php if($course['grade']=="Grade 11") echo "selected"; ?>>
                            Grade 11
                        </option>

                    </select>
                </div>

                <button type="submit" name="update" class="btn btn-success">
                    Update Course
                </button>

                <a href="view-courses.php" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>