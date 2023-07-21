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

$sqluser = "select * from tb_users where id='$user_id'";
$queryuser = mysqli_query($conn, $sqluser);
$resultuser = mysqli_fetch_array($queryuser);
$email = $resultuser['email'];
$username = $resultuser['username'];
$fullname = $resultuser['fullname'];
$profile_photo = $resultuser['photo'];
?>