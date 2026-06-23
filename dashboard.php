<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome <?php echo $_SESSION['username']; ?></h2>

<hr>

<a href="create.php">➕ Add Post</a><br><br>
<a href="index.php">📄 View Posts</a><br><br>
<a href="logout.php">🚪 Logout</a>