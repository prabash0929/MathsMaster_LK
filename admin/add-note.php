<?php

include '../config/db.php';

$message = "";

$courses = mysqli_query($conn, "SELECT * FROM courses");

if(isset($_POST['upload']))
{
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];

    $file_name = $_FILES['pdf']['name'];
    $temp_name = $_FILES['pdf']['tmp_name'];

    move_uploaded_file(
        $temp_name,
        "../uploads/notes/" . $file_name
    );

    $sql = "INSERT INTO notes(course_id,title,file_name)
            VALUES('$course_id','$title','$file_name')";

    if(mysqli_query($conn,$sql))
    {
        $message = "PDF Uploaded Successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Note</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Upload Note</h2>

<p><?php echo $message; ?></p>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Course</label>

<select name="course_id" class="form-control">

<?php while($course=mysqli_fetch_assoc($courses)) { ?>

<option value="<?php echo $course['id']; ?>">
<?php echo $course['title']; ?>
</option>

<?php } ?>

</select>
</div>

<div class="mb-3">
<label>Note Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>PDF File</label>
<input type="file" name="pdf" class="form-control" accept=".pdf" required>
</div>

<button type="submit" name="upload" class="btn btn-primary">
Upload PDF
</button>

</form>

</div>

</body>
</html>