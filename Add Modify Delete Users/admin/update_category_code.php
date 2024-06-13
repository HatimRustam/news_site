<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/admin/index.php");
    }
    if ($_SESSION["role"] == '1') {
        header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/admin/post.php");
    }
?>
<?php
if (isset($_POST["submit"])) {
    include "configure.php";
    $uid = mysqli_real_escape_string($connection, $_POST["category_id"]);
    $fname = mysqli_real_escape_string($connection, $_POST["category_name"]);
    $query = "SELECT category_name FROM category WHERE category_name = '{$fname}' AND category_id != '{$uid}'";
    $sql = mysqli_query($connection, $query) or die("query fail");
    if (mysqli_num_rows($sql) > 0) {
        echo "<script>
        alert('Category Already Exist');
        window.location.href = 'category.php'; // Replace with the appropriate page
    </script>";
    } else {
        $query_1 = "UPDATE category SET category_name = '{$fname}' WHERE category_id = '{$uid}'";
        if (mysqli_query($connection, $query_1)) {
            header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/category.php");
        }
    }
}
?>