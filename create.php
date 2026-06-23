<?php
include("auth.php");
include("db.php");

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts(title, content) VALUES('$title','$content')";

    if(mysqli_query($conn,$sql)){
        echo "Post Created Successfully";
    } else {
        echo "Error";
    }
}
?>

<h2>Add New Post</h2>

<form method="POST">

<input type="text" name="title" placeholder="Title" required>
<br><br>

<textarea name="content" placeholder="Content" required></textarea>
<br><br>

<button name="submit">Create Post</button>

</form>

<br>
<a href="dashboard.php">Back</a>