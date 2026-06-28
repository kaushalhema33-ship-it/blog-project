<?php
include("db.php");

$message="";

if(isset($_POST['register'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($username=="" || $password==""){
        $message="All fields are required.";
    }else{

        $check=$conn->prepare("SELECT id FROM users WHERE username=?");
        $check->bind_param("s",$username);
        $check->execute();
        $result=$check->get_result();

        if($result->num_rows>0){

            $message="Username already exists.";

        }else{

            $hash=password_hash($password,PASSWORD_DEFAULT);

            $stmt=$conn->prepare("INSERT INTO users(username,password) VALUES(?,?)");
            $stmt->bind_param("ss",$username,$hash);

            if($stmt->execute()){

                header("Location: login.php");

                exit();

            }else{

                $message="Registration Failed.";

            }

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3 class="text-center">

Register

</h3>

</div>

<div class="card-body">

<?php

if($message!=""){

echo "<div class='alert alert-danger'>$message</div>";

}

?>

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
class="btn btn-success w-100"
name="register">

Register

</button>

</form>

<br>

<div class="text-center">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>