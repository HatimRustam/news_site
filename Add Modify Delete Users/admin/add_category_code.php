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
    $fname = mysqli_real_escape_string($connection, $_POST["category_name"]);
    $query = "select category_name from category where category_name = '{$fname}'";
    $sql = mysqli_query($connection, $query) or die("query fail");
    if (mysqli_num_rows($sql) > 0) {
        echo "<script>
        alert('Category Already Exist');
        window.location.href = 'add_category.php'; // Replace with the appropriate page
    </script>";
    } else {
        $query_1 = "insert into category(category_name)
            values('{$fname}')";
        if (mysqli_query($connection, $query_1)) {
            header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/category.php");
        }
    }
}
?>