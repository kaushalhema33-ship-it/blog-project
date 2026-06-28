<?php
include("auth.php");
include("db.php");

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM posts WHERE id=$id");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$title=$_POST['title'];
$content=$_POST['content'];

$stmt=$conn->prepare("UPDATE posts SET title=?,content=? WHERE id=?");
$stmt->bind_param("ssi",$title,$content,$id);

if($stmt->execute()){

header("Location:index.php?msg=updated");
exit();

}

}
?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Post</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Edit Post</h2>

<form method="POST">

<input
type="text"
name="title"
class="form-control mb-3"
value="<?php echo htmlspecialchars($row['title']); ?>"
required>

<textarea
name="content"
class="form-control mb-3"
rows="5"
required><?php echo htmlspecialchars($row['content']); ?></textarea>

<button
class="btn btn-warning"
name="update">

Update

</button>

<a href="index.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</body>

</html>