<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/index.php");
    }
?>
<?php
    include "configure.php";
    session_start();
    session_unset();
    session_destroy();
    header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/index.php");
?>