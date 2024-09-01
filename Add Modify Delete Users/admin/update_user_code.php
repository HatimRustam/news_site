<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/admin/index.php");
    }
    if ($_SESSION["role"] == '1') {
        header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/admin/post.php");
    }
?>
<?php
if (isset($_POST["submit"])) {
    include "configure.php";
    $uid = mysqli_real_escape_string($connection, $_POST["user_id"]);
    $fname = mysqli_real_escape_string($connection, $_POST["first_name"]);
    $lname = mysqli_real_escape_string($connection, $_POST["last_name"]);
    $uname = mysqli_real_escape_string($connection, $_POST["user_name"]);
    $role = mysqli_real_escape_string($connection, $_POST["role"]);
    $query = "SELECT user_name FROM user WHERE user_name = '{$uname}' AND user_id != '{$uid}'";
    $sql = mysqli_query($connection, $query) or die("query fail");
    if (mysqli_num_rows($sql) > 0) {
        echo "<script>
        alert('User Already Exist');
        window.location.href = 'index.php'; // Replace with the appropriate page
    </script>";
    } else {
        $query_1 = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', user_name = '{$uname}', role = '{$role}' WHERE user_id = '{$uid}'";
        if (mysqli_query($connection, $query_1)) {
            header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/user.php");
        }
    }
}
?>