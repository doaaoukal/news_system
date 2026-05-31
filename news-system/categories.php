<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$result = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h3>All Categories</h3>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
            </tr>
            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>