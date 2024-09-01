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
                Edit User
            </div>
            <div class="form_align">
                <?php
                include "configure.php";
                $id = $_GET["id"];
                $query = "select * from user where user_id = {$id}";
                $sql = mysqli_query($connection, $query) or die(mysqli_error($connection));;
                if (mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                        <form action="update_user_code.php" method="post" autocomplete="off">
                            <input type="hidden" name="user_id" value="<?php echo $row["user_id"]; ?>">
                            <label for="fname">First Name</label>
                            <input type="text" name="first_name" id="" value="<?php echo $row["first_name"]; ?>">
                            <label for="fname">Last Name</label>
                            <input type="text" name="last_name" id="" value="<?php echo $row["last_name"]; ?>">
                            <label for="fname">Username</label>
                            <input type="text" name="user_name" id="" value="<?php echo $row["user_name"]; ?>">
                            <label for="fname">Role</label>
                            <select name="role" id="">
                                <option disabled>Select Role</option>
                                <option value="1" <?php echo ($row["role"] == "1") ? "selected" : ""; ?>>User</option>
                                <option value="2" <?php echo ($row["role"] == "2") ? "selected" : ""; ?>>Admin</option>
                            </select>
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
            var userConfirmed = window.confirm('Are you sure you want to Update this user?');
            return userConfirmed;
        }
    </script>
</body>

</html>