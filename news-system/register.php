<?php

include "db.php";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(name, email, password)
            VALUES ('$name', '$email', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Account Created Successfully";
    } else {
        echo "Error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">Create Account</h2>

                <form method="POST">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" name="register" class="btn btn-dark w-100">
                        Register
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>