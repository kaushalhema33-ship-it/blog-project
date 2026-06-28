<?php
include("auth.php");
include("db.php");

// Total Users
$userResult = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users");
$user = mysqli_fetch_assoc($userResult);

// Total Posts
$postResult = mysqli_query($conn, "SELECT COUNT(*) AS total_posts FROM posts");
$post = mysqli_fetch_assoc($postResult);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fa;
}
.card{
    border-radius:15px;
}
</style>

</head>
<body>

<div class="container mt-5">

<h2 class="text-center mb-4">📚 Blog Management Dashboard</h2>

<div class="alert alert-success">
Welcome <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>
</div>

<div class="row">

<div class="col-md-6">
<div class="card bg-primary text-white shadow mb-3">
<div class="card-body text-center">
<h4>Total Users</h4>
<h1><?php echo $user['total_users']; ?></h1>
</div>
</div>
</div>

<div class="col-md-6">
<div class="card bg-success text-white shadow mb-3">
<div class="card-body text-center">
<h4>Total Posts</h4>
<h1><?php echo $post['total_posts']; ?></h1>
</div>
</div>
</div>

</div>

<div class="text-center mt-4">

<a href="create.php" class="btn btn-success btn-lg">
➕ Add Post
</a>

<a href="index.php" class="btn btn-primary btn-lg">
📄 View Posts
</a>

<a href="logout.php" class="btn btn-danger btn-lg">
🚪 Logout
</a>

</div>

</div>

</body>
</html>