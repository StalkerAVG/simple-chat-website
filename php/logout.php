<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy(); // destroy all sessions
    header("Location: ../index"); // redirect to login page
    exit();
}
else{
    header("Location: ../chat");
}
?>