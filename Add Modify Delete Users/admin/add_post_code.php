<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/index.php");
}
?>
<?php
include "configure.php";
if (isset($_FILES["post_img"])) {
    $error = array();
    $filename = $_FILES["post_img"]["name"];
    $filesize = $_FILES["post_img"]["size"];
    $filetmp = $_FILES["post_img"]["tmp_name"];
    $filetype = $_FILES["post_img"]["type"];
    $fileext = end(explode('.',$filename));
    $extension = array("apng","avif","jpeg","png","svg","webp");
    if(in_array($fileext,$extension)===false){
        $error[]="this extension is not allow plz use this formate jpeg,png,jpg";
    }
    if($filesize>2000000){
        $error[]="file size must in 2mb";
    }
    if(empty($error)==true){
        move_uploaded_file($filetmp,"upload/".$filename);
    }
    else{
        print_r($error);
        die();
    }
}
$title = mysqli_real_escape_string($connection, $_POST["title"]);
$desc = mysqli_real_escape_string($connection, $_POST["description"]);
$category = mysqli_real_escape_string($connection, $_POST["category"]);
$date = date("d-M-Y");
$author = $_SESSION["user_id"];
$query = "insert into post(title,description,category,post_date,author,post_img) values('{$title}','{$desc}',{$category},'{$date}','{$author}','{$filename}');";
$query .= "update category set post = post + 1 where category_id = {$category}";
if(mysqli_multi_query($connection,$query)){
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/post.php");
}
?>