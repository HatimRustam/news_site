<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/index.php");
    }
    if ($_SESSION["role"] == '1') {
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/post.php");
    }
?>
<?php
if (isset($_POST["save"])) {
    include "configure.php";
    $fname = mysqli_real_escape_string($connection, $_POST["first_name"]);
    $lname = mysqli_real_escape_string($connection, $_POST["last_name"]);
    $uname = mysqli_real_escape_string($connection, $_POST["user_name"]);
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($connection, $_POST["role"]);
    $query = "select user_name from user where user_name = '{$uname}'";
    $sql = mysqli_query($connection, $query) or die("query fail");
    if (mysqli_num_rows($sql) > 0) {
        echo "<script>
        alert('User Already Exist');
        window.location.href = 'add_user.php'; // Replace with the appropriate page
    </script>";
    } else {
        $query_1 = "insert into user(first_name,last_name,user_name,password,role)
            values('{$fname}','{$lname}','{$uname}','{$pass}',{$role})";
        if (mysqli_query($connection, $query_1)) {
            if(!isset($_SESSION["user_name"])){
                header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/post.php");
            }else{
                header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/user.php");
            }
        }
    }
}
?>