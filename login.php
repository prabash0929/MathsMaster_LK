<?php

session_start();

include 'config/db.php';

$message = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password']))
        {
            // Session Data
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // ==========================
            // Learning Streak System
            // ==========================

            $date = date("Y-m-d");

            $check = mysqli_query(
                $conn,
                "SELECT * FROM login_streak WHERE user_id=".$user['id']
            );

            if(mysqli_num_rows($check) == 0)
            {
                mysqli_query(
                    $conn,
                    "INSERT INTO login_streak(user_id,streak_days,last_login)
                    VALUES(".$user['id'].",1,'$date')"
                );
            }
            else
            {
                $row = mysqli_fetch_assoc($check);

                $yesterday = date("Y-m-d",strtotime("-1 day"));

                if($row['last_login'] == $yesterday)
                {
                    $newStreak = $row['streak_days'] + 1;

                    mysqli_query(
                        $conn,
                        "UPDATE login_streak
                        SET streak_days='$newStreak',
                        last_login='$date'
                        WHERE user_id=".$user['id']
                    );
                }
                elseif($row['last_login'] != $date)
                {
                    mysqli_query(
                        $conn,
                        "UPDATE login_streak
                        SET streak_days=1,
                        last_login='$date'
                        WHERE user_id=".$user['id']
                    );
                }
            }

            // Redirect by Role

            if($user['role'] == 'admin')
            {
                header("Location: admin/dashboard.php");
            }
            else
            {
                header("Location: student/dashboard.php");
            }

            exit();
        }
        else
        {
            $message = "Wrong Password";
        }
    }
    else
    {
        $message = "User Not Found";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header">
<h3>Login</h3>
</div>

<div class="card-body">

<?php
if($message != "")
{
    echo "<div class='alert alert-danger'>$message</div>";
}
?>

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-success w-100">
Login
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>