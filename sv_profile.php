<?php
include "config/security.php";
include "config/connection.php";

$act = $_POST['act'];
$id = $_POST['id'];
$user_id = $_POST['id'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$newpet = $_POST['newpet'];


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
    $pet = $result['pet_id'];
    $pp = $result['photo'];
    echo "|" . $fullname . "|" . $email . "|" . $user_id . "|" . $pet . "|" . $pp . "|";

} else if ($act == "updateProfile") {
    $sqlcheckpass = "SELECT password, pet_id, xp from tb_users WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sqlcheckpass);
    $result = mysqli_fetch_array($query);
    $pass = $result['password']; //bentuknya MD5
    $pet = $result['pet_id'];
    $xp = $result['xp'];

    $action_type = "updateProfile";
    $addition_command = "";
    $exec = true;
    if ($newpass != "") {
        if ($oldpass == $pass) {
            $newpass = md5($newpass);
            $addition_command .= ", password = '$newpass'";
            $action_type = "updateProfilePassword";
        } else {
            $message = "Password lama Anda salah!";
            $action_type = "wrongPassword";
            $exec = false;
        }
    }

    // if ($newpet != $pet) {
    //     //get new pet phase id
    //     $sql1 = "SELECT * FROM tb_pet_phases LEFT JOIN tb_users ON tb_pet_phases.id = tb_users.pet_phases WHERE xp >= min_xp AND xp <= max_xp AND tb_pet_phases.pet_id='$newpet'";
    //     $query1 = mysqli_query($conn, $sql1);
    //     $result1 = mysqli_fetch_array($query1);
    //     $pet_phase_id = $result1['pet_phases_id'];

    //     $addition_command .= ", pet_id='$newpet', pet_phases='$pet_phase_id'";
    // }

    if ($exec) {
        $profile_img = ''; // inisialisasi variable dengan nilai default kosong

        if (isset($_FILES['profile_img']) && $_FILES['profile_img']['size'] > 0) {
            // user mengunggah file baru
            $file = $_FILES['profile_img'];
            $file_name = md5($file['name']) . '_' . date('y-m-d') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
            $file_tmp = $file['tmp_name'];

            //folder tujuan
            $folder = './assets/images/';

            //pindahkan file ke dalam folder tujuan
            if (move_uploaded_file($file_tmp, $folder . $file_name)) {
                // File berhasil diunggah ke folder tujuan.
                $profile_img = $file_name;
            } else {
                $response = array(
                    'action_type' => 'error',
                    'message' => 'Gagal mengunggah file.'
                );
                echo json_encode($response);
                exit; // Keluar dari script karena gagal mengunggah file.
            }
        } else {
            // User tidak mengunggah file baru, gunakan data yang ada di database
            $sqlProfile = "SELECT photo FROM tb_users WHERE id='$user_id'";
            $queryProfile = mysqli_query($conn, $sqlProfile);
            $resultProfile = mysqli_fetch_array($queryProfile);
            $profile_img = $resultProfile['profile_img'];


            $sql_update = "UPDATE tb_users SET fullname = '$fullname', email = '$email', photo = '$change_picture', pet_id='$newpet' $addition_command WHERE id = '$user_id'";
            $run_query_check = mysqli_query($conn, $sql_update) or die($sql_update);

            $message = "Data Berhasil diubah!";
        }
    }
    echo "|" . $action_type . "|" . $message . "|";
}
?>