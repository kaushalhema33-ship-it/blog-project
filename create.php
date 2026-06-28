 <?php
include("auth.php");
include("db.php");

if(isset($_POST['submit'])){

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if($title=="" || $content==""){
        $error = "All fields are required!";
    }else{

        $stmt = $conn->prepare("INSERT INTO posts(title,content) VALUES(?,?)");
        $stmt->bind_param("ss",$title,$content);

        if($stmt->execute()){
            header("Location: index.php?msg=added");
            exit();
        }else{
            $error = "Something went wrong!";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Create Post</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h2>Add New Post</h2>

</div>

<div class="card-body">

<?php
if(isset($error)){
?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php
}
?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Title

</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Content

</label>

<textarea
name="content"
class="form-control"
rows="6"
required></textarea>

</div>

<button
type="submit"
name="submit"
class="btn btn-success">

Create Post

</button>

<a href="dashboard.php"
class="btn btn-secondary">

Back

</a>

<a href="index.php"
class="btn btn-primary">

View Posts

</a>

</form>

</div>

</div>

</div>

</body>
</html>