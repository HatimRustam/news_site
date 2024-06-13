<?php
    session_start();
?>
<?php
if (isset($_POST["Login"])) {
    include "configure.php";  // Include your database connection file

    $username = mysqli_real_escape_string($connection, $_POST["user_name"]);
    $password = $_POST["password"];

    // Fetch user data from the database based on the entered username
    $query = "SELECT user_id, role, user_name, password FROM user WHERE user_name = '{$username}'";
    $result = mysqli_query($connection, $query);

    if ($result && $user = mysqli_fetch_assoc($result)) {
        // Verify the entered password against the stored hashed password
        if (password_verify($password, $user["password"])) {
            // Authentication successful, store user information in session
            $_SESSION["user_name"] = $user["user_name"];
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["role"] = $user["role"];

            header("location:http://localhost/Add%20Modify%20Delete%20Users/admin/user.php");
            exit;
        } else {
            echo "<script>
                alert('Invalid Password');
                window.location.href = 'index.php'; // Replace with the appropriate page
            </script>";
        }
    } else {
        echo "<script>
            alert('Invalid Username');
            window.location.href = 'index.php'; // Replace with the appropriate page
        </script>";
    }

    mysqli_close($connection);
}
?>
