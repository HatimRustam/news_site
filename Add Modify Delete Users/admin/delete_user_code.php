<?php
    // session_start();
    // if ($_SESSION["role"] == '1') {
    //     header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/post.php");
    // }
    // if(!isset($_SESSION["user_name"])){
    //     header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/index.php");
    // }
?>
<?php
    // include "configure.php";
    // $uid = $_GET["id"];
    // $query = "delete from user where user_id = {$uid}";
    // if(mysqli_query($connection,$query) or die("query fail")){
    //     header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/user.php");
    // }else {
    //     echo "Error deleting record: " . mysqli_error($connection);
    // }
?>

<!-- New code -->

<?php
session_start();
if ($_SESSION["role"] == '1') {
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/post.php");
}
if(!isset($_SESSION["user_name"])){
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/index.php");
}

include "configure.php";

$uid = $_GET["id"];

// Delete all posts associated with the user
$query_posts = "SELECT post_id, post_img FROM post WHERE user_id = {$uid}";
$sql_posts = mysqli_query($connection, $query_posts);

while ($row = mysqli_fetch_assoc($sql_posts)) {
    unlink("upload/".$row["post_img"]); // Delete the post image from the server
    $query_delete_post = "DELETE FROM post WHERE post_id = {$row['post_id']}";
    mysqli_query($connection, $query_delete_post);
}

// Delete the user
$query = "DELETE FROM user WHERE user_id = {$uid}";
if (mysqli_query($connection, $query)) {
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/user.php");
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}
?>
