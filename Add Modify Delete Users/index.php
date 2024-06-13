<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS 24</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="Favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Favicon/favicon-16x16.png">
    <link rel="manifest" href="Favicon/site.webmanifest">
    <link rel="stylesheet" href="css/front_index.css">
</head>

<body>
    <header>
        <div class="header1">
            <div class="logo">
                <a href="index.php">NEWS 24</a>
                <div class="search">
                    <form action="search.php" method="get">
                        <input type="search" name="search" id="" placeholder="Search">
                    </form>
                </div>
            </div>
            <div class="button">
            <a href="admin/add_user.php">Sign in</a>
            <a href="admin/index.php">Log in</a>
        </div>
        </div>
        <nav>
            <?php
            include "configure.php";
            $limit_of_nav = 5;
            $query_1 = "SELECT * FROM category WHERE post > 0 LIMIT {$limit_of_nav}";
            $sql_1 = mysqli_query($connection, $query_1) or die("querry fail 1");
            if (mysqli_num_rows($sql_1) > 0) {
                $active_nav = "";

            ?>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php
                    while ($row_1 = mysqli_fetch_assoc($sql_1)) {
                        echo "<li><a class='{$active_nav}' href='category.php?cid={$row_1['category_id']}'>{$row_1['category_name']}</a></li>";
                    }
                    ?>
                </ul>
            <?php
            }
            ?>
        </nav>
    </header>
    <main>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
            <div class="carousel-inner">
                <?php
                include "configure.php";
                $limit_3 = 3;
                $query_3 = "SELECT post.post_id, post.title, post.description, category.category_name,
                    post.category, post.post_img FROM post
                    LEFT JOIN category ON post.category = category.category_id
                    ORDER BY post.post_id DESC LIMIT {$limit_3}";
                $sql_3 = mysqli_query($connection, $query_3) or die("Query failed");

                $active = true; // Flag to set the first carousel item as active

                while ($row_3 = mysqli_fetch_assoc($sql_3)) {
                ?>
                    <div class="carousel-item <?php if ($active) {
                                                    echo "active";
                                                    $active = false;
                                                } ?>">
                        <a href="single_page.php?id=<?php echo $row_3["post_id"]; ?>"><img src="admin/upload/<?php echo $row_3['post_img']; ?>" class="width-img" alt="..."></a>
                        <div class="carousel-caption">
                            <h5><?php echo $row_3["title"]; ?></h5>
                            <p><?php echo $row_3["description"]; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <?php
        include "configure.php";
        if (isset($_GET["pages"])) {
            $page = $_GET["pages"];
        } else {
            $page = 1;
        }
        $limit = 6;
        $offset = ($page - 1) * $limit;
        $query = "select post.post_id,post.title,post.description,post.post_date,category.category_name,user.user_name,post.category,post.post_img from post
                        left join category on post.category = category.category_id
                        left join user on post.author = user.user_id
                        order by post.post_id desc limit {$offset},{$limit}";
        $sql = mysqli_query($connection, $query) or die("Query fail");
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
        ?>
                <div class="card_container">
                    <a href="single_page.php?id=<?php echo $row["post_id"]; ?>" style="text-decoration: none;">
                        <div class="card_element">
                            <div class="image">
                                <img src="admin/upload/<?php echo $row["post_img"]; ?>" alt="">
                            </div>
                            <div class="card_info">
                                <div class="title">
                                    <h3><?php echo $row["title"]; ?></h3>
                                </div>
                                <div class="tag_author_date">
                                    <div class="tag">
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="darkgray" class="bi bi-tags" viewBox="0 0 16 16">
                                                <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z" />
                                                <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z" />
                                            </svg></span> <span><?php echo $row["category_name"]; ?></span>
                                    </div>
                                    <div class="author">
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="darkgray" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                            </svg></span> <span><?php echo $row["user_name"]; ?></span>
                                    </div>
                                    <div class="date">
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="darkgray" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z" />
                                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                            </svg></span> <span><?php echo $row["post_date"]; ?></span>
                                    </div>
                                </div>
                                <div class="description"><?php echo $row["description"]; ?></div>
                            </div>
                        </div>
                    </a>
                </div>
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
        <?php
        $query1 = "select * from post";
        $sql1 = mysqli_query($connection, $query1) or die("querry fail");
        if (mysqli_num_rows($sql1) > 0) {
            // $page = $_GET["page"];
            $total_record = mysqli_num_rows($sql1);
            // $limit = 5;
            $total_pages = ceil($total_record / $limit);
            // $offset =($page-1)*$limit;
            echo '<ul class="pagination">';
            if ($page > 1) {
                echo '<li><a href="index.php?pages=' . ($page - 1) . '">&laquo; PREV</a></li>';
            }
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $active = "active";
                } else {
                    $active = "";
                }
                echo '<li><a href="index.php?pages=' . $i . '" class="' . $active . '">' . $i . '</a></li>';
            }
            if ($total_pages > $page) {
                echo '<li><a href="index.php?pages=' . ($page + 1) . '">NEXT &raquo;</a></li>';
            }
            echo '</ul>';
        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>