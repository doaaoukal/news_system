<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$sql = "SELECT news.*, categories.category_name 
        FROM news 
        JOIN categories ON news.category_id = categories.id
        WHERE news.status != 'deleted'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h3>All News</h3>

        <table class="table table-bordered text-center">

            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td>
                    <img src="images/<?php echo $row['image']; ?>" width="80">
                </td>
                <td>

                    <a href="edit-news.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                    <a href="delete-news.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>

                </td>
            </tr>
            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>