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
                <p class="profile_detail"><b>Hello,
                        <?php echo $username; ?>! Let's Customize Your Account.
                    </b>
                <form class="usercard_edit" id="usercard_edit">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="profile_flex">
                        <div>
                            <p class="usercard_fullname">Fullname</p>
                            <input class="input" type="text" id="fullname" name="fullname" placeholder="Add Fullname..."
                                required>
                        </div>
                        <div>
                            <p class="usercard_mail">Email</p>
                            <input class="input" type="text" id="email" name="email" placeholder="Add Email..."
                                required>
                            </p>
                        </div>
                        <!-- <p class="password">Password</p>
                    <input class="input" type="password" placeholder="Type Your Password..." id="password"
                        name="password" required><br /> -->
                        <input class="button_save" type="button" value="Save changes" name="submit"
                            onclick="update_profile()" />
                    </div>
                    <div>
                        <p class="usercard_old_pass">Old Password</p>
                        <input class="input" type="text" id="oldpass" name="oldpass" placeholder="Type Old Password...">
                    </div>
                    <div>
                        <p class="usercard_new_pass">New Password</p>
                        <input class="input" type="text" id="newpass" name="newpass" placeholder="Type New Password...">
                        </p>
                    </div>
                </form>
                <p class="change_pet"><b>Customize Pet</b>
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
    <!-- Script -->
    <script src="./assets/js/jquery-3.7.0.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            edit_profile(<?php echo $user_id; ?>);
        });
    </script>
</body>

</html>