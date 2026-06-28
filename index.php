<?php
include("auth.php");
include("db.php");

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1){
    $page = 1;
}

$start = ($page - 1) * $limit;

$search = "";

if(isset($_GET['search']) && $_GET['search'] != "")
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $sql = "SELECT * FROM posts
            WHERE title LIKE '%$search%'
            OR content LIKE '%$search%'
            ORDER BY id DESC
            LIMIT $start,$limit";

    $count_sql = "SELECT COUNT(*) AS total
                  FROM posts
                  WHERE title LIKE '%$search%'
                  OR content LIKE '%$search%'";
}
else
{
    $sql = "SELECT * FROM posts
            ORDER BY id DESC
            LIMIT $start,$limit";

    $count_sql = "SELECT COUNT(*) AS total FROM posts";
}

$result = mysqli_query($conn,$sql);

$count_result = mysqli_query($conn,$count_sql);
$total = mysqli_fetch_assoc($count_result);

$total_pages = ceil($total['total']/$limit);
?>

<!DOCTYPE html>
<html>

<head>

<title>Blog Posts</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h2 class="text-center mb-4">
Blog Management System
</h2>
<?php

if(isset($_GET['msg'])){

if($_GET['msg']=="added"){

echo "<div class='alert alert-success'>
Post Added Successfully
</div>";

}

if($_GET['msg']=="updated"){

echo "<div class='alert alert-warning'>
Post Updated Successfully
</div>";

}

if($_GET['msg']=="deleted"){

echo "<div class='alert alert-danger'>
Post Deleted Successfully
</div>";

}

}

?>


}

}
?>

<div class="mb-3">

<a href="dashboard.php" class="btn btn-primary">
Dashboard
</a>

<a href="create.php" class="btn btn-success">
Add Post
</a>

<a href="logout.php" class="btn btn-danger float-end">
Logout
</a>

</div>

<form method="GET">

<div class="input-group mb-4">

<input
type="text"
name="search"
class="form-control"
placeholder="Search..."
value="<?php echo htmlspecialchars($search); ?>">

<button class="btn btn-dark">
Search
</button>

</div>

</form>

<?php

if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="card mb-3 shadow">

<div class="card-body">

<h3>

<?php echo htmlspecialchars($row['title']); ?>

</h3>

<p>

<?php echo nl2br(htmlspecialchars($row['content'])); ?>

</p>

<p class="text-muted">

<?php echo $row['created_at']; ?>

</p>

<a
href="edit.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this post?')">

Delete

</a>

</div>

</div>

<?php

}

}
else
{

echo "<div class='alert alert-warning'>
No Posts Found
</div>";

}

?>

<nav>

<ul class="pagination justify-content-center">

<?php

for($i=1;$i<=$total_pages;$i++)
{

?>

<li class="page-item <?php if($page==$i) echo "active"; ?>">

<a
class="page-link"
href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">

<?php echo $i; ?>

</a>

</li>

<?php

}

?>

</ul>

</nav>

</div>

</body>

</html>