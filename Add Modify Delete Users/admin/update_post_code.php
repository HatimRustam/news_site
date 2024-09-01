<?php
session_start();
if(!isset($_SESSION["user_name"])){
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/admin/index.php");
    exit;
}
?>

<?php
include "configure.php";

if(empty($_FILES["post_img"]["name"])){
    $filename = $_POST["old_img"];
}else{
    $error = array();
    $filename = $_FILES["post_img"]["name"];
    $filesize = $_FILES["post_img"]["size"];
    $filetmp = $_FILES["post_img"]["tmp_name"];
    $filetype = $_FILES["post_img"]["type"];
    $fileext = end(explode('.',$filename));
    $extension = array("jpeg","png","jpg");
    if(in_array($fileext,$extension) === false){
        $error[] = "This extension is not allowed, please use the format jpeg, png, jpg.";
    }
    if($filesize > 2000000){
        $error[] = "File size must be within 2MB.";
    }
    if(empty($error) == true){
        move_uploaded_file($filetmp, "upload/" . $filename);
    } else {
        print_r($error);
        die();
    }
}

$title = mysqli_real_escape_string($connection, $_POST["title"]);
$description = mysqli_real_escape_string($connection, $_POST["description"]);
$category = mysqli_real_escape_string($connection, $_POST["category"]);
$post_id = mysqli_real_escape_string($connection, $_POST["post_id"]);
$old_category = mysqli_real_escape_string($connection, $_POST["old_category"]);

$query = "UPDATE post SET title = '{$title}', description = '{$description}', category = {$category}, post_img = '{$filename}' WHERE post_id = {$post_id};";

if($old_category != $category){
    $query .= "UPDATE category SET post = post - 1 WHERE category_id = {$old_category};";
    $query .= "UPDATE category SET post = post + 1 WHERE category_id = {$category};";
}

$sql = mysqli_multi_query($connection, $query) or die("Query failed: " . mysqli_error($connection));

if($sql){
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/post.php");
    exit;
}
?>
