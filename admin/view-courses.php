<?php

include '../config/db.php';

$result = mysqli_query($conn, "SELECT * FROM courses");

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Courses</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>All Courses</h2>

    <a href="add-course.php" class="btn btn-primary mb-3">
        Add New Course
    </a>

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <tr>
                <td><?php echo $row['id']; ?></td>

                <td><?php echo $row['title']; ?></td>

                <td><?php echo $row['description']; ?></td>

                <td><?php echo $row['grade']; ?></td>

                <td>
                    <a href="edit-course.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="delete-course.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this course?');">
                        Delete
                    </a>
                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>