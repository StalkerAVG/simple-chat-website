<?php
session_start();
ob_start();
include_once "db.php";

if (isset($_SESSION['user_id'])  && isset($_FILES["uploaded"])){
	$filename = $_FILES["uploaded"]["name"];
    $tempname = $_FILES["uploaded"]["tmp_name"];
    $folder = "../images/" . $filename;
    $fileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));
    $uploadOk = True;
	$user = $_SESSION['user_id'];

    // Check file size
    if ($_FILES["uploaded"]["size"] > 5000000) {
        $_SESSION['flash']['error'] = "Sorry, your file is too large.";
        $_SESSION['flash']['type'] = 'error';
        $uploadOk = False;
    }
    // Allow certain file formats
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
        && $fileType != "gif" ) {
        $_SESSION['flash']['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['flash']['type'] = 'error';
        $uploadOk = False;
    }

    if($uploadOk){// Now let's move the uploaded image into the folder: image
        if (!move_uploaded_file($tempname, $folder)) {
            $_SESSION['flash']['error'] = 'Something went wrong';
            $_SESSION['flash']['type'] = 'error';
            $sql = "UPDATE `users` SET `profile_img`='$filename' WHERE `id`='$user' ";

            // Execute query
            mysqli_query($connection, $sql);
        }
        else{
            $_SESSION['flash']['error'] = "Sorry, unable to upload your file";
            $_SESSION['flash']['type'] = 'error';
        }
    }
}
header('Location: ../chat');
ob_end_flush();
?>