<?php
session_start();
include("db.php");

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // user fetch
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        // password check
        if(password_verify($password, $row['password'])){

            $_SESSION['username'] = $username;

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Wrong Password!";
        }

    } else {
        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body{
            font-family: Arial;
            background:#f2f2f2;
        }
        .box{
            width:350px;
            margin:100px auto;
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
            background:blue;
            color:white;
            border:none;
            cursor:pointer;
        }
        p{
            color:red;
            text-align:center;
        }
    </style>
</head>
<body>

<div class="box">

    <h2 align="center">Login</h2>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button name="login">Login</button>

    </form>

    <br>

    <center>
        Don't have account? <a href="register.php">Register</a>
    </center>

</div>

</body>
</html>