<?php
include("db.php");

$message = "";

if(isset($_POST['register'])){

    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($check) > 0){
        $message = "Username already exists!";
    } else {
        $sql = "INSERT INTO users(username,password)
                VALUES('$username','$password')";

        if(mysqli_query($conn,$sql)){
            $message = "Registration Successful!";
        } else {
            $message = "Something went wrong!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body{
            font-family:Arial;
            background:#f2f2f2;
        }
        .box{
            width:350px;
            margin:80px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }
        input{
            width:100%;
            padding:10px;
            margin:10px 0;
        }
        button{
            width:100%;
            padding:10px;
            background:green;
            color:white;
            border:none;
            cursor:pointer;
        }
        p{
            color:red;
            text-align:center;
        }
        a{
            text-decoration:none;
        }
    </style>
</head>
<body>
<div class="box">
<h2 align="center">Register</h2>
<p><?php echo $message; ?></p>
<form method="POST">

<input type="text" name="username" placeholder="Enter Username" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button name="register">Register</button>

</form>

<br>

<center>
Already have an account?
<br><br>
<a href="login.php">Login Here</a>
</center>

</div>

</body>
</html>