<?php
session_start();
ob_start();
include_once "db.php";

if (isset($_POST['register'])){

    $username = $_POST['username_r'];
    $password = $_POST['password_r'];

    // Input validation
    if (strlen($username) < 3) {
        $_SESSION['flash']['error'] = 'Username must be at least 3 characters long';
        $_SESSION['flash']['type'] = 'error';
        header("Location: ../index");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['flash']['error'] = 'Password must be at least 8 characters long';
        $_SESSION['flash']['type'] = 'error';
        header("Location: ../index");
        exit();
    }

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['flash']['error'] = 'This username is already taken';
        $_SESSION['flash']['type'] = 'error';
        header("Location: ../index");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($connection, $insert_query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        try {
            mysqli_stmt_execute($stmt);
            $_SESSION['flash']['error'] = 'You can now log in';
            $_SESSION['flash']['type'] = 'success';
        } catch (Exception $e) {
            $_SESSION['flash']['error'] = 'An error occurred while registering your account';
            $_SESSION['flash']['type'] = 'error';
            header("Location: ../index");
            exit();
        }
        header("Location: ../index");
        exit();
    }
}
ob_end_flush();
?>
