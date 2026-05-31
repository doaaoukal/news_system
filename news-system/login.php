<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE email='$email' 
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    if ($user) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: dashboard.php");
        exit();

    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">Login</h2>

                <form method="POST">

                    <!-- Email -->
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- Button -->
                    <button type="submit" name="login" class="btn btn-dark w-100">
                        Login
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>