<?php
session_start();

if(isset($_SESSION['user_id'])){
    include_once "db.php";
    $output = "";
    $query = mysqli_query($connection, "SELECT * FROM `chat`");
    $previoussender = null;

    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)) {
			$sender = $row['sender'];
			$img_query = mysqli_query($connection, "SELECT `profile_img` FROM `users` WHERE `id`='$sender'");
			$img = mysqli_fetch_assoc($img_query)['profile_img'];
            if ($sender === $_SESSION['user_id']) {
                $output .= '<div class="sent message">
                                    <div class="user-info">
                                        <div class="username">'. $row['nick'] .'</div>
                                        <img class="user-image" src="../images/'.$img.'" alt="user image">
                                    </div>
                                     <p>'. $row['message'] .'</p>
                                    </div>';
            } else {
                if ($sender === $previoussender){
                    $output .= '<div class="received message">
                                     <p>'. $row['message'] .'</p>
                                    </div>';
                }
                else{
                    $output .= '<div class="received message">
                                    <div class="user-info">
                                        <div class="username">'. $row['nick'] .'</div>
                                        <img class="user-image" src="../images/'.$img.'" alt="user image">
                                    </div>
                                     <p>'. $row['message'] .'</p>
                                    </div>';
                }
            }
            $previoussender = $sender;
        }
    }
        else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
            echo $output;
        }
    else{
        header("location: ../index");
        exit;
    }
