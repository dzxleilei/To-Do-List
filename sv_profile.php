<?php
include "config/security.php";
include "config/connection.php";

$act = $_POST['act'];
$id = $_POST['id'];
$user_id = $_POST['id'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];

$oldpass = md5($_POST['oldpass']);
if (empty($oldpass)) {
    $oldpass = "";
}

$newpass = $_POST['newpass'];
if (empty($newpass)) {
    $newpass = "";
}

if ($act == "editProfile") {
    $sql = "SELECT * FROM tb_users WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    $user_id = $id;
    $fullname = $result['fullname'];
    $email = $result['email'];
    echo "|" . $fullname . "|" . $email . "|" . $user_id . "|";

} else if ($act == "updateProfile") {
    $sqlcheckpass = "SELECT password, pet_id from tb_users WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sqlcheckpass);
    $result = mysqli_fetch_array($query);
    $pass = $result['password']; //bentuknya MD5
    $current_pet_id = $result['pet_id'];

    $action_type = "updateProfile";
    $addition_command = "";
    $exec = true;
    if ($newpass != "") {
        if ($oldpass == $pass) {
            $newpass = md5($newpass);
            $addition_command = ", password = '$newpass'";
            $action_type = "updateProfilePassword";
        } else {
            $message = "password lama Anda salah!";
            $action_type = "wrongPassword";
            $exec = false;
        }
    }

    if ($exec) {
        $sql_update = "UPDATE tb_users SET fullname = '$fullname', email = '$email' $addition_command WHERE id = '$user_id'";
        $run_query_check = mysqli_query($conn, $sql_update) or die($sql_update);

        $message = "Data Berhasil diubah";
    }

    echo "|" . $action_type . "|" . $message . "|";
}
?>