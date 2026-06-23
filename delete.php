<?php
include("auth.php");
include("db.php");

$id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id=$id";

if(mysqli_query($conn,$sql)){
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting post";
}
?>