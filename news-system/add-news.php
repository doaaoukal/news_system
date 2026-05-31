<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

// جلب الفئات
$categories = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_POST['add_news'])) {

    $title = $_POST['title'];
    $details = $_POST['details'];
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['user_id'];

    // الصورة
    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp_name, "images/" . $image_name);

    $sql = "INSERT INTO news(title, details, image, category_id, user_id)
            VALUES ('$title', '$details', '$image_name', '$category_id', '$user_id')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('News Added Successfully');</script>";
    } else {
        echo "<script>alert('Error adding news');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">Add News</h2>

                <form method="POST" enctype="multipart/form-data">

                    <!-- Title -->
                    <div class="mb-3">
                        <label>News Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <!-- Details -->
                    <div class="mb-3">
                        <label>News Details</label>
                        <textarea name="details" class="form-control" rows="5" required></textarea>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select Category</option>

                            <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                                <option value="<?php echo $cat['id']; ?>">
                                    <?php echo $cat['category_name']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label>News Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <button type="submit" name="add_news" class="btn btn-dark w-100">
                        Add News
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>