<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$id = $_GET['id'];

// جلب الخبر القديم
$sql = "SELECT * FROM news WHERE id=$id";
$result = mysqli_query($conn, $sql);
$news = mysqli_fetch_assoc($result);

// جلب الفئات
$categories = mysqli_query($conn, "SELECT * FROM categories");

// تحديث البيانات
if (isset($_POST['update_news'])) {

    $title = $_POST['title'];
    $details = $_POST['details'];
    $category_id = $_POST['category_id'];

    if ($_FILES['image']['name'] != "") {

        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp_name, "images/" . $image_name);

    } else {

        $image_name = $news['image'];
    }

    $update = "UPDATE news SET
                title='$title',
                details='$details',
                image='$image_name',
                category_id='$category_id'
               WHERE id=$id";

    mysqli_query($conn, $update);

    header("Location: all-news.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit News</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">Edit News</h2>

                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">

                        <label>Title</label>

                        <input type="text"
                               name="title"
                               value="<?php echo $news['title']; ?>"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-3">

                        <label>Details</label>

                        <textarea name="details"
                                  class="form-control"
                                  rows="5"
                                  required><?php echo $news['details']; ?></textarea>

                    </div>

                    <div class="mb-3">

                        <label>Category</label>

                        <select name="category_id" class="form-control">

                            <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>

                            <option value="<?php echo $cat['id']; ?>"
                                <?php if ($cat['id'] == $news['category_id']) echo "selected"; ?>>

                                <?php echo $cat['category_name']; ?>

                            </option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Image</label><br>

                        <img src="images/<?php echo $news['image']; ?>" width="100"><br><br>

                        <input type="file" name="image" class="form-control">

                    </div>

                    <button type="submit"
                            name="update_news"
                            class="btn btn-dark w-100">

                        Update News

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>