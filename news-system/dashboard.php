<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$news = mysqli_query($conn,"
SELECT news.*, categories.category_name
FROM news
LEFT JOIN categories
ON news.category_id = categories.id
WHERE status != 'deleted'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 text-center">

    <h1>Welcome <?php echo $_SESSION['user_name']; ?> 👋</h1>

    <div class="mt-4">

        <a href="add-category.php" class="btn btn-primary">Add Category</a>

        <a href="categories.php" class="btn btn-info">View Categories</a>

        <a href="add-news.php" class="btn btn-success">Add News</a>

        <a href="all-news.php" class="btn btn-dark">All News</a>

        <a href="deleted-news.php" class="btn btn-danger">Deleted News</a>

        <a href="logout.php" class="btn btn-outline-danger mt-3">Logout</a>

    </div>

    <div class="card mt-5 shadow p-3">

        <h3>All News</h3>

        <table class="table table-bordered table-striped">

            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($news)) { ?>

            <tr>

                <td><?php echo $row['id']; ?></td>

                <td><?php echo $row['title']; ?></td>

                <td><?php echo $row['category_name']; ?></td>

                <td>
                    <img src="images/<?php echo $row['image']; ?>" width="80">
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>