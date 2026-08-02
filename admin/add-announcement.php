<?php

session_start();
include '../config/db.php';

$msg = "";

if(isset($_POST['save']))
{
    $title = $_POST['title'];
    $message = $_POST['message'];

    mysqli_query(
        $conn,
        "INSERT INTO announcements(title,message)
         VALUES('$title','$message')"
    );

    $msg = "✅ Announcement Added Successfully!";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Add Announcement</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fc;
}

.card{
    border:none;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3 class="mb-0">
📢 Add Announcement
</h3>

</div>

<div class="card-body">

<?php if($msg!=""){ ?>

<div class="alert alert-success">
<?php echo $msg; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Title
</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Message
</label>

<textarea
name="message"
rows="5"
class="form-control"
required></textarea>

</div>

<button
type="submit"
name="save"
class="btn btn-primary">

📢 Publish Announcement

</button>

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Back

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>