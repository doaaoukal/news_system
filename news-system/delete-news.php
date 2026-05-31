<?php

include "db.php";

$id = $_GET['id'];

mysqli_query($conn, "UPDATE news SET status='deleted' WHERE id=$id");

header("Location: all-news.php");

?>