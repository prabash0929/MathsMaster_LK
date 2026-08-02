<?php
session_start();
include '../config/db.php';

$announcements = mysqli_query(
    $conn,
    "SELECT * FROM announcements
     ORDER BY id DESC
     LIMIT 3"
);

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

/* Get Streak */
$streak = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT streak_days
         FROM login_streak
         WHERE user_id=".$_SESSION['user_id']
    )
);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>MathMaster LK - Student Dashboard</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fc;
    font-family:'Segoe UI',sans-serif;
}

/* Navbar */
.navbar{
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

/* Hero */
.hero{
    background:linear-gradient(135deg,#0d6efd,#4f46e5);
    color:white;
    padding:40px;
    border-radius:20px;
    margin-top:30px;
    margin-bottom:20px;
}

/* Streak Box */
.streak-box{
    background:#fff3cd;
    border-left:5px solid #ffc107;
    padding:15px;
    border-radius:10px;
    margin-bottom:25px;
    font-size:18px;
}

/* Grade Cards */
.grade-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:0.3s;
}

.grade-card:hover{
    transform:translateY(-8px);
}

.grade-card img{
    height:260px;
    object-fit:cover;
}

/* Quick Cards */
.quick-card{
    background:white;
    border-radius:15px;
    padding:20px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,0.08);
    transition:0.3s;
}

.quick-card:hover{
    transform:translateY(-5px);
}

/* Footer */
.footer{
    margin-top:50px;
    padding:20px;
    text-align:center;
    color:#666;
}

</style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand" href="#">
🎓 MathMaster LK
</a>

<div>

<a href="results.php" class="btn btn-light btn-sm">
📊 Results
</a>

<a href="leaderboard.php" class="btn btn-warning btn-sm">
🏆 Leaderboard
</a>

<a href="../logout.php" class="btn btn-danger btn-sm">
🚪 Logout
</a>

</div>

</div>

</nav>

<div class="container">

<!-- Hero -->

<div class="hero">

<h2>👋 Welcome, <?php echo $_SESSION['name']; ?></h2>

<p class="mb-0">
Learn Mathematics with Videos, Notes, PDFs and Quizzes.
Select your grade and start learning.
</p>

</div>

<h3 class="mb-3">📢 Announcements</h3>

<?php while($a=mysqli_fetch_assoc($announcements)){ ?>

<div class="alert alert-info shadow-sm">

<strong>
<?php echo $a['title']; ?>
</strong>

<br>

<?php echo $a['message']; ?>

</div>

<?php } ?>

<!-- Learning Streak -->

<div class="streak-box">
🔥 Learning Streak:
<strong>
<?php echo $streak['streak_days'] ?? 1; ?>
Day(s)
</strong>
</div>

<!-- Grade Cards -->

<div class="row">

<div class="col-md-6 mb-4">

<div class="card grade-card shadow">

<img src="../assets/images/grade10.png" alt="Grade 10">

<div class="card-body text-center">

<h3>📘 Grade 10</h3>

<p class="text-muted">
Lessons, Notes, PDFs & Quizzes
</p>

<a href="grade.php?grade=Grade 10"
class="btn btn-primary">

Open Grade 10

</a>

</div>

</div>

</div>

<div class="col-md-6 mb-4">

<div class="card grade-card shadow">

<img src="../assets/images/grade11.png" alt="Grade 11">

<div class="card-body text-center">

<h3>📗 Grade 11</h3>

<p class="text-muted">
Lessons, Notes, PDFs & Quizzes
</p>

<a href="grade.php?grade=Grade 11"
class="btn btn-success">

Open Grade 11

</a>

</div>

</div>

</div>

</div>

<!-- Quick Access -->

<h3 class="mb-3">🚀 Quick Access</h3>

<div class="row">

<div class="col-md-4 mb-3">

<div class="quick-card">

<h4>📊 My Results</h4>

<p>View all quiz scores</p>

<a href="results.php" class="btn btn-info">
Open
</a>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="quick-card">

<h4>🏆 Leaderboard</h4>

<p>See top performing students</p>

<a href="leaderboard.php" class="btn btn-warning">
Open
</a>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="quick-card">

<h4>🎓 Certificate</h4>

<p>Download your certificate</p>

<a href="certificate.php" class="btn btn-success">
Open
</a>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="quick-card">

<h4>❤️ Favorites</h4>

<p>Saved Lessons</p>

<a href="favorites.php" class="btn btn-danger">
Open
</a>

</div>

</div>

</div>

<!-- Footer -->

<div class="footer">

© <?php echo date("Y"); ?> MathMaster LK | Developed by Prabash Sandakalum

</div>

</div>

</body>
</html>