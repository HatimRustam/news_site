<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/admin/index.php");
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
    $querry = "UPDATE post set title = '{$_POST["title"]}', description = '{$_POST["description"]}', category = {$_POST["category"]}, post_img = '{$filename}' WHERE post_id = {$_POST["post_id"]};";
    if($_POST["old_category"] != $_POST["category"]){
        $querry .= "update category set post = post - 1 where category_id = {$_POST['old_category']};";
        $querry .= "update category set post = post + 1 where category_id = {$_POST["category"]};";
    }
    $sql = mysqli_multi_query($connection,$querry) or die("query fail");
    if($sql){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/post.php");
    }
?>