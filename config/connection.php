<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "to_do_list";

$conn = mysqli_connect($server, $user, $pass, $db);

if (!$conn) {
    die("Database Error!");
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$profile_photo = $_SESSION['photo'];
?>