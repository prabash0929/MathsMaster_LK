```php
<?php

session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$grade = $_GET['grade'];

$search = $_GET['search'] ?? '';

$courses = mysqli_query(
    $conn,
    "SELECT * FROM courses
     WHERE grade='$grade'
     AND title LIKE '%$search%'"
);

$totalCourses = mysqli_num_rows($courses);

?>

<!DOCTYPE html>
<html>
<head>

<title><?php echo $grade; ?></title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fc;
    font-family:'Segoe UI',sans-serif;
}

/* Hero */

.hero{
    background:linear-gradient(135deg,#0d6efd,#4f46e5);
    color:white;
    padding:35px;
    border-radius:20px;
    margin-bottom:25px;
}

/* Course Cards */

.course-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:0.3s;
}

.course-card:hover{
    transform:translateY(-8px);
}

.course-icon{
    font-size:60px;
    text-align:center;
    padding-top:20px;
}

/* Footer */

.footer{
    text-align:center;
    margin-top:50px;
    color:#666;
    padding:20px;
}

.search-box{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 0 10px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

</style>

</head>

<body>

<div class="container mt-4">

<!-- Hero -->

<div class="hero">

<h2>📚 <?php echo $grade; ?></h2>

<p class="mb-0">
Select a lesson and start learning Mathematics.
</p>

</div>

<!-- Back Button -->

<a href="dashboard.php" class="btn btn-secondary mb-3">
⬅ Back to Dashboard
</a>

<!-- Total Lessons -->

<div class="alert alert-info">
📚 Total Lessons:
<strong><?php echo $totalCourses; ?></strong>
</div>

<!-- Search -->

<div class="search-box">

<form method="GET">

<input type="hidden"
       name="grade"
       value="<?php echo $grade; ?>">

<div class="input-group">

<input
type="text"
name="search"
class="form-control"
placeholder="🔍 Search Lessons..."
value="<?php echo $search; ?>">

<button class="btn btn-primary">
Search
</button>

</div>

</form>

</div>

<!-- Courses -->

<div class="row">

<?php

if(mysqli_num_rows($courses) > 0)
{

mysqli_data_seek($courses,0);

while($course=mysqli_fetch_assoc($courses))
{
?>

<div class="col-md-4 mb-4">

<div class="card course-card shadow">

<div class="course-icon">
📘
</div>

<div class="card-body text-center">

<h4><?php echo $course['title']; ?></h4>

<p class="text-muted">
<?php echo $course['description']; ?>
</p>

<a href="course.php?id=<?php echo $course['id']; ?>"
class="btn btn-primary">

Open Lesson

</a>

</div>

</div>

</div>

<?php
}
}
else
{
?>

<div class="col-12">

<div class="alert alert-warning text-center">

❌ No lessons found.

</div>

</div>

<?php
}
?>

</div>

<div class="footer">
© <?php echo date("Y"); ?> MathMaster LK | Developed by Prabash Sandakalum
</div>

</div>

</body>
</html>
```
