<?php
session_start();
include_once 'db.php';

if (isset($_SESSION['user_id'])){

    $sender = $_SESSION['user_id'];
    $nickname = $_SESSION['user_name'];
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    print($_POST);

    if(!empty($message)){
        $sql = mysqli_query($connection, "INSERT INTO `chat`(`sender`,`nick`,`message`) VALUES ('$sender','$nickname','$message')") or die();
    }
}
else{
    header("Location: ../index");
}
?>