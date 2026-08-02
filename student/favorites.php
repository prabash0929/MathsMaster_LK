<?php

session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT lessons.*
     FROM favorites
     JOIN lessons
     ON lessons.id = favorites.lesson_id
     WHERE favorites.user_id = '$user_id'"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Favorites</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>❤️ My Favorite Lessons</h2>

<hr>

<?php while($lesson = mysqli_fetch_assoc($result)){ ?>

<div class="card mb-3 shadow">

<div class="card-body">

<h5><?php echo $lesson['title']; ?></h5>

<a href="<?php echo $lesson['video_url']; ?>"
target="_blank"
class="btn btn-primary">
▶ Watch Video
</a>

</div>

</div>

<?php } ?>

</div>

</body>
</html>