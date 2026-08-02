<?php

session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$course = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM courses WHERE id='$id'")
);

$lessons = mysqli_query($conn,
"SELECT * FROM lessons WHERE course_id='$id'");

$notes = mysqli_query($conn,
"SELECT * FROM notes WHERE course_id='$id'");

?>

<!DOCTYPE html>
<html>
<head>

<title><?php echo $course['title']; ?></title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fc;
}

/* Hero */

.hero{
    background:linear-gradient(135deg,#0d6efd,#4f46e5);
    color:white;
    padding:35px;
    border-radius:20px;
    margin-bottom:30px;
}

/* Cards */

.custom-card{
    border:none;
    border-radius:20px;
    transition:0.3s;
}

.custom-card:hover{
    transform:translateY(-5px);
}

.section-title{
    margin-bottom:20px;
    font-weight:bold;
}

.footer{
    text-align:center;
    margin-top:40px;
    color:#666;
    padding:20px;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="hero">

<h2>📚 <?php echo $course['title']; ?></h2>

<p class="mb-0">
Learn through videos, notes and quizzes.
</p>

</div>

<a href="javascript:history.back()" class="btn btn-secondary mb-4">
⬅ Back
</a>

<!-- Video Lessons -->

<h3 class="section-title">🎥 Video Lessons</h3>

<div class="row">

<?php while($lesson=mysqli_fetch_assoc($lessons)){ ?>

<div class="col-md-6 mb-3">

<div class="card custom-card shadow">

<div class="card-body">

<h5><?php echo $lesson['title']; ?></h5>

<p class="text-muted">
Watch this lesson video.
</p>

<a href="<?php echo $lesson['video_url']; ?>"
target="_blank"
class="btn btn-primary">

▶ Watch Video

</a>

<a href="favorite.php?id=<?php echo $lesson['id']; ?>"
class="btn btn-danger">
❤️ Favorite
</a>

</div>

</div>

</div>

<?php } ?>

</div>

<!-- Notes -->

<h3 class="section-title mt-4">📄 Notes & PDFs</h3>

<div class="row">

<?php while($note=mysqli_fetch_assoc($notes)){ ?>

<div class="col-md-6 mb-3">

<div class="card custom-card shadow">

<div class="card-body">

<h5><?php echo $note['title']; ?></h5>

<p class="text-muted">
Study material and PDF notes.
</p>

<a href="../uploads/notes/<?php echo $note['file_name']; ?>"
target="_blank"
class="btn btn-success">

📥 Open PDF

</a>

</div>

</div>

</div>

<?php } ?>

</div>

<!-- Quiz Button -->

<div class="text-center mt-5">

<a href="quizzes.php" class="btn btn-warning btn-lg">
📝 Start Quiz
</a>

</div>

<div class="footer">
© <?php echo date("Y"); ?> MathMaster LK
</div>

</div>

</body>
</html>