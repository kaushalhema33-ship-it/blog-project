<?php
include("db.php");
include("auth.php");
?>

<h2>All Posts</h2>

<a href="dashboard.php">⬅ Back</a>
<br><br>

<?php

$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
        ?>

        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['content']; ?></p>

            <small><?php echo $row['created_at']; ?></small>

            <br><br>

            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        </div>

        <?php
    }

}else{
    echo "No Posts Found";
}

?>