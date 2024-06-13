<?php
    include "configure.php";
    $id = $_GET["id"];
    $catid = $_GET["catid"];
    $query1 = "select * from post where post_id = {$id};";
    $sql1 = mysqli_query($connection,$query1);
    $row = mysqli_fetch_assoc($sql1);
    unlink("upload/".$row["post_img"]);
    $query = "delete from post where post_id = {$id};";
    $query .= "update category set post = post - 1 where category_id = {$catid}";
    if(mysqli_multi_query($connection,$query)){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/post.php");
    }
?>