<?php
    session_start();
    if ($_SESSION["role"] == '1') {
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/post.php");
    }
    if(!isset($_SESSION["user_name"])){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/index.php");
    }
?>
<?php
    include "configure.php";
    $uid = $_GET["id"];
    $query = "delete from user where user_id = {$uid}";
    if(mysqli_query($connection,$query) or die("query fail")){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/user.php");
    }else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
?>