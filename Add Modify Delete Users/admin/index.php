<?php
    session_start();
    if(isset($_SESSION["user_name"])){
        header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/user.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS 24</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../Favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Favicon/favicon-16x16.png">
    <link rel="manifest" href="../Favicon/site.webmanifest">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <div class="container">
        <div class="logo">NEWS 24</div>
        <form action="login_code.php" method="post" autocomplete="off">
            <label for="uname">User Name</label>
            <input type="text" name="user_name" id="" required>
            <label for="pass">Password</label>
            <input type="password" name="password" id="" required>
            <input type="submit" name="Login" value="Login" style="margin-top: 1.5%;">
        </form>
    </div>
</body>

</html>