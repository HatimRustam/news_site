<?php
include "configure.php";
session_start();
if (!isset($_SESSION["user_name"])) {
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/index.php");
}
if ($_SESSION["role"] == '1') {
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/post.php");
}
if ($_SESSION["role"] == '2') {
    header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/post.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>