<?php
include("auth.php");
include("db.php");

$id = $_GET['id'];

// old data fetch
$sql = "SELECT * FROM posts WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if(mysqli_query($conn,$sql)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating post";
    }
}
?>

<h2>Edit Post</h2>

<form method="POST">

<input type="text" name="title" value="<?php echo $row['title']; ?>" required>
<br><br>

<textarea name="content" required><?php echo $row['content']; ?></textarea>
<br><br>

<button name="update">Update Post</button>

</form>

<br>
<a href="index.php">Back</a>