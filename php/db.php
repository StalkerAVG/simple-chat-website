<?php
$connection= mysqli_connect('localhost','root','','testchat');
if ( $connection == false )
{
    die('Unable to connect to database<br>' . mysqli_connect_error());
}
?>