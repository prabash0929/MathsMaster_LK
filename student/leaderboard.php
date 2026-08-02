<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn,"
SELECT users.name, SUM(results.score) AS total_score
FROM results
JOIN users ON results.student_id = users.id
GROUP BY results.student_id
ORDER BY total_score DESC
");

$rank = 1;
?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.top1 {
    background: gold;
    font-weight: bold;
}
.top2 {
    background: silver;
    font-weight: bold;
}
.top3 {
    background: #cd7f32;
    font-weight: bold;
    color: white;
}
</style>

</head>
<body>

<div class="container mt-5">

<h2>🏆 Leaderboard</h2>

<table class="table table-bordered table-striped mt-3">

<tr>
<th>Rank</th>
<th>Student Name</th>
<th>Total Score</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr
<?php
if($rank == 1) echo 'class="top1"';
else if($rank == 2) echo 'class="top2"';
else if($rank == 3) echo 'class="top3"';
?>>

<td>
<?php
if($rank == 1) echo "🥇";
else if($rank == 2) echo "🥈";
else if($rank == 3) echo "🥉";
else echo $rank;
?>
</td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['total_score']; ?></td>

</tr>

<?php $rank++; } ?>

</table>

</div>

</body>
</html>