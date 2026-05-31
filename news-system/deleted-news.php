<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$result = mysqli_query($conn,"
SELECT news.*, categories.category_name
FROM news
LEFT JOIN categories
ON news.category_id = categories.id
WHERE news.status='deleted'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Deleted News</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h3>Deleted News</h3>

        <table class="table table-bordered table-striped">

            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

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