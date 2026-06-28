<?php
include("auth.php");
include("db.php");

// Total Users
$userQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM users");
$user = mysqli_fetch_assoc($userQuery);

// Total Posts
$postQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM posts");
$post = mysqli_fetch_assoc($postQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="style.css">

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h2>📚 Blog Admin</h2>

<a href="dashboard.php">
<i class="bi bi-speedometer2"></i>
Dashboard
</a>

<a href="create.php">
<i class="bi bi-plus-circle"></i>
Add Post
</a>

<a href="index.php">
<i class="bi bi-file-earmark-text"></i>
View Posts
</a>

<a href="logout.php">
<i class="bi bi-box-arrow-right"></i>
Logout
</a>

</div>

<!-- Main -->

<div class="main">

<nav class="navbar bg-white shadow rounded mb-4">

<div class="container-fluid">

<h3>

Dashboard

</h3>

<span>

Welcome,
<b>

<?php echo htmlspecialchars($_SESSION['username']); ?>

</b>

👋

</span>

</div>

</nav>

<div class="row">

<div class="col-md-4">
<div class="card bg-primary text-white shadow">
    <div class="card-body text-center">
        <i class="bi bi-people-fill" style="font-size:40px;"></i>

        <h5 class="mt-3">Total Users</h5>

        <h1><?php echo $user['total']; ?></h1>
    </div>
</div>

</div>

<div class="col-md-4">

<div class="card bg-success text-white shadow">

<div class="card-body text-center">

<i class="bi bi-file-earmark-post-fill" style="font-size:40px;"></i>

<h5 class="mt-3">

Total Posts

</h5>

<h1>

<?php echo $post['total']; ?>

</h1>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-warning text-dark shadow">

<div class="card-body text-center">

<i class="bi bi-calendar-check-fill" style="font-size:40px;"></i>

<h5 class="mt-3">

Today's Date

</h5>

<h4>

<?php echo date("d M Y"); ?>

</h4>

</div>

</div>

</div>

</div>

<br>

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h4>

Recent Posts

</h4>

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>ID</th>

<th>Title</th>

<th>Content</th>

</tr>

</thead>

<tbody>

<?php

$result = mysqli_query($conn,"SELECT * FROM posts ORDER BY id DESC LIMIT 5");

while($row = mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['title']); ?></td>

<td><?php echo htmlspecialchars(substr($row['content'],0,60)); ?>...</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>