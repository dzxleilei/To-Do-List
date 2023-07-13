<?php
include "config/security.php";
include "config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Code Blaze - Profile</title>

    <link rel="stylesheet" href="assets/css/style_profile.css" />
    <link rel="icon" type="image/x-icon" href="" />
</head>

<body>
    <div class="container_usercard">
        <div class="title_back">
            <div class="title"><b>
                    <p>Edit Profile</p>
                </b></div>
            <div class="button_back">
                <a href="home.php">BACK</a>
            </div>
        </div>
        <div class="usercard">
            <div class="profile_picture">
                <a href="profile.php"><img src="assets/images/<?php echo $profile_photo; ?>" alt="Avatar" /></a>
                <b>
                    <center>
                        <p class="change_picture">Change Picture</p>
                    </center>
                </b>
            </div>
            <div class="usercard_info">
                <p class="profile_detail"><b>Profile Details</b>
                <form class="usercard_edit" id="usercard_edit">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="profile_flex">
                        <div>
                            <p class="usercard_fullname">Fullname</p>
                            <input class="input" type="text" value="<?php echo $fullname; ?>" id="fullname"
                                name="fullname" required>
                        </div>
                        <div>
                            <p class="usercard_mail">Email</p>
                            <input class="input" type="text" value="<?php echo $email; ?>" id="email" name="email"
                                required>
                            </p>
                        </div>
                        <!-- <p class="password">Password</p>
                    <input class="input" type="password" placeholder="Type Your Password..." id="password"
                        name="password" required><br /> -->
                        <input class="button_save" type="submit" value="Save changes" name="submit" />
                    </div>
                </form>
                <p class="change_pet"><b>Change Pet</b>
                <form class="pet_edit" id="pet_edit">
                    <p class="pet_drop">Choose Pet</p>
                    <select name="pet_dropdown" id="pet_dropdown">
                        <option value="" selected disabled>Select Pet</option>
                        <option value="1"></option>
                        <option value="2"></option>
                        <option value="3"></option>
                    </select>
            </div>
        </div>
    </div>