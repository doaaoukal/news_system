<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

if (isset($_POST['add_category'])) {

    $name = $_POST['category_name'];

    mysqli_query($conn, "INSERT INTO categories(category_name) VALUES('$name')");

    echo "<script>alert('Category Added');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h3>Add Category</h3>

        <form method="POST">

            <input type="text" name="category_name" class="form-control mb-3" placeholder="Category Name" required>

            <button class="btn btn-primary" name="add_category">Add</button>

        </form>

    </div>

</div>

</body>
</html>