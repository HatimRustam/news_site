<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/index.php");
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
    <link rel="stylesheet" href="../css/add_post.css">
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
                Add Post
            </div>
            <div class="form_align">
                <form action="add_post_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <label for="">Title</label>
                    <input type="text" name="title" id="">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="3" rows="3"></textarea>
                    <label for="">Category</label>
                    <select name="category" id="">
                        <option selected disabled>Select Category</option>
                        <?php
                        include "configure.php";
                        $query = "select * from category";
                        $sql = mysqli_query($connection, $query) or die("Query fail");
                        if (mysqli_num_rows($sql) > 0) {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="">Post Image</label>
                    <input type="file" accept=".png/*,.jpg/*,.jpej/*" src="" alt="" name="post_img">
                    <input type="submit" name="save" style="margin-top: 1%;" onclick='return confirmDelete();'>
                </form>
            </div>
        </main>
    </div>
    <script>
        function confirmDelete() {
            var userConfirmed = window.confirm('Are you sure you want to Add this post?');
            return userConfirmed;
        }
    </script>
</body>

</html>