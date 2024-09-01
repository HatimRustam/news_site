<?php
session_start();
if (!isset($_SESSION["user_name"])) {
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
    <link rel="stylesheet" href="../css/user.css">
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
            <div class="info">
                <div class="user-big">
                    All Categories
                </div>
                <div class="add">
                    <a href="add_category.php">Add Category</a>
                </div>
            </div>
            <div class="table">
                <div class="table-container">
                    <table id="tabel">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>CATEGORY NAME</th>
                                <th>NO. OF POSTS</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "configure.php";
                            if (isset($_GET["pages"])) {
                                $page = $_GET["pages"];
                            } else {
                                $page = 1;
                            }
                            $limit = 6;
                            $offset = ($page - 1) * $limit;
                            $query = "select * from category order by category_id desc limit {$offset},{$limit}";
                            $sql = mysqli_query($connection, $query) or die("Query fail");
                            if (mysqli_num_rows($sql) > 0) {
                                while ($row = mysqli_fetch_assoc($sql)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row["category_id"]; ?></td>
                                        <td><?php echo $row["category_name"]; ?></td>
                                        <td><?php echo $row["post"]; ?></td>
                                        <td>
                                            <a href='update_category.php?id=<?php echo $row["category_id"]; ?>'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='delete_category_code.php?id=<?php echo $row["category_id"]; ?>&category_name=<?php echo $row["category_name"]; ?>' onclick='return confirmDelete("<?php echo $row["category_name"]; ?>");'>

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<h1 class='data'>No Data Found</h1>";
                                echo '
                            <script>
                            // Get the element by its ID
                            var myElement = document.getElementById("tabel");
                    
                            // Set the display property to none
                            myElement.style.display = "none";
                        </script>
                            ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


                <!-- pagination code = video == 3 -->

                <?php
                $query1 = "select * from user";
                $sql1 = mysqli_query($connection, $query1) or die("querry fail");
                if (mysqli_num_rows($sql1) > 0) {
                    // $page = $_GET["page"];
                    $total_record = mysqli_num_rows($sql1);
                    // $limit = 5;
                    $total_pages = ceil($total_record / $limit);
                    // $offset =($page-1)*$limit;
                    echo '<ul class="pagination">';
                    if ($page > 1) {
                        echo '<li><a href="user.php?pages=' . ($page - 1) . '">&laquo; PREV</a></li>';
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo '<li><a href="user.php?pages=' . $i . '" class="' . $active . '">' . $i . '</a></li>';
                    }
                    if ($total_pages > $page) {
                        echo '<li><a href="user.php?pages=' . ($page + 1) . '">NEXT &raquo;</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
        </main>
    </div>
    <script>
        function confirmDelete(category_name) {
            var userConfirmed = window.confirm('Are you sure you want to delete the category: ' + category_name + ' ?');
            return userConfirmed;
        }
    </script>

</body>

</html>