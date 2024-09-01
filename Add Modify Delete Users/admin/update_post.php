<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/index.php");
}
if($_SESSION["role"] == 1){
    include "configure.php";
    $post = $_GET["id"];
    $query2 = "select author from post where post_id = {$post}";
    $sql2 = mysqli_query($connection, $query2) or die("Query fail");
    $row2 = mysqli_fetch_assoc($sql2);
    if($row2["author"] != $_SESSION["user_id"]){
    header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/post.php");
    }
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
    <link rel="stylesheet" href="../css/update_post.css">
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
                Update Post
            </div>
            <div class="form_align">
                <?php
                    include "configure.php";
                    $post = $_GET["id"];
                    $query = "select post.post_id,post.title,post.description,post_img,
                    category.category_name,post.category from post
                    left join category on post.category = category.category_id
                    left join user on post.author = user.user_id
                    where post.post_id = {$post}";
                    $sql = mysqli_query($connection, $query) or die("Query fail");
                        if (mysqli_num_rows($sql) > 0) {
                            while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                <form action="update_post_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
                    <label for="">Title</label>
                    <input type="text" name="title" id="" value="<?php echo $row['title']; ?>">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="3" rows="3"><?php echo $row['description']; ?></textarea>
                    <label for="">Category</label>
                    <select name="category" id="">
                        <option selected disabled>Select Category</option>
                        <?php
                        include "configure.php";
                        $query1 = "select * from category";
                        $sql1 = mysqli_query($connection, $query1) or die("Query fail");
                        if (mysqli_num_rows($sql1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($sql1)) {
                                if($row["category"]==$row1["category_id"]){
                                    $selected = "selected";
                                }else{
                                    $selected = "";
                                }
                                echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                            }
                        }
                        ?>
                        <input type="hidden" name="old_category" value="<?php echo $row["category"]; ?>">
                    </select>
                    <label for="">Post Image</label>
                    <input type="file" accept=".png/*,.jpg/*,.jpej/*" id="img" alt="" name="post_img">
                    <img src="upload/<?php echo $row['post_img']; ?>" alt="">
                    <input type="hidden" name="old_img" value="<?php echo $row['post_img']; ?>">
                    <input type="submit" name="save" style="margin-top: 1%;" onclick='return confirmDelete();'>
                </form>
                <?php
                            }
                        } else {
                            echo "<h1 class='data'>No Data Found</h1>";
                        }
                        ?>
            </div>
        </main>
    </div>
    <script>
        function confirmDelete() {
            var userConfirmed = window.confirm('Are you sure you want to update this post?');
            return userConfirmed;
        }
        console.log($post);
    </script>
</body>

</html>