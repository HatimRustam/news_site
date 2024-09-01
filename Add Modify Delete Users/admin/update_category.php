<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/index.php");
    }
    if ($_SESSION["role"] == '1') {
        header("location:http://localhost/news_site/Add%20Modify%20Delete%20Users/admin/post.php");
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
    <link rel="stylesheet" href="../css/Update_user.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="header1">
                <div class="logo">
                    <a href="post.php">NEWS 24</a>
                </div>
                <div class="username">
                <h1><?php echo $_SESSION["user_name"]; ?></h1>
                </div>
                <div class="logout">
                    <a href="logout_code.php">Logout</a>
                </div>
            </div>
            <nav>
            <ul>
                    <li><a href="post.php">POST</a></li>
                    <?php
                    if ($_SESSION["role"] == '2') {
                    ?>
                        <li><a href="user.php">USER</a></li>
                        <li><a href="category.php">CATEGORY</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </header>
        <main>
            <div class="head">
                Edit Category
            </div>
            <div class="form_align">
                <?php
                include "configure.php";
                $id = $_GET["id"];
                $query = "select * from category where category_id = {$id}";
                $sql = mysqli_query($connection, $query) or die(mysqli_error($connection));;
                if (mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                        <form action="update_category_code.php" method="post" autocomplete="off">
                            <input type="hidden" name="category_id" value="<?php echo $row["category_id"]; ?>">
                            <label for="fname">Category Name</label>
                            <input type="text" name="category_name" id="" value="<?php echo $row["category_name"]; ?>">
                            <input type="submit" name="submit" style="margin-top: 1%;" onclick='return confirmDelete();'>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </main>
    </div>
    <script>
        function confirmDelete() {
            var userConfirmed = window.confirm('Are you sure you want to Update this category?');
            return userConfirmed;
        }
    </script>
</body>

</html>