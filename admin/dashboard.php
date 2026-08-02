<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    die("Access Denied");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>👨‍💼 Admin Dashboard</h2>

    <p>Welcome <?php echo $_SESSION['name']; ?></p>

    <hr>

    <div class="row">

        <div class="col-md-3 mb-3">
            <a href="add-course.php" class="btn btn-primary w-100">
                ➕ Add Course
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="view-courses.php" class="btn btn-success w-100">
                📚 View Courses
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="add-lesson.php" class="btn btn-info w-100">
                🎥 Add Lesson
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="view-lessons.php" class="btn btn-secondary w-100">
                📖 View Lessons
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="add-note.php" class="btn btn-warning w-100">
                📄 Upload Notes
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="view-notes.php" class="btn btn-dark w-100">
                📂 View Notes
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="add-quiz.php" class="btn btn-primary w-100">
                📝 Add Quiz
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="add-question.php" class="btn btn-success w-100">
                ❓ Add Question
            </a>
        </div>

        <!-- New Buttons -->

        <div class="col-md-3 mb-3">
            <a href="add-announcement.php" class="btn btn-warning w-100">
                📢 Announcements
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="students.php" class="btn btn-info w-100">
                👥 Students
            </a>
        </div>

    </div>

    <hr>

    <a href="../logout.php" class="btn btn-danger">
        🚪 Logout
    </a>

</div>

</body>
</html>