<?php
session_start();
ob_start();
include_once "db.php";

if (isset($_POST['login'])){

    $name = $_POST['username_l'];
    $password = $_POST['password_l'];

    $check_name = mysqli_query($connection, "SELECT * FROM users WHERE `username` LIKE '$name'");
    $row = mysqli_fetch_assoc($check_name);

    if (!$row) {
        $_SESSION['flash']['error'] = 'Wrong login or password';
        $_SESSION['flash']['type'] = 'error';
    } else {
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['username'];

            // Redirect to another page
            header('Location: ../chat');
            exit();
        }
        else{
            $_SESSION['flash']['error'] = 'Wrong login or password';
            $_SESSION['flash']['type'] = 'error';
        }
    }
}
header("Location: ../index");
ob_end_flush();
?>
