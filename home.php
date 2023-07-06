<?php
include "config/security.php";
include "config/connection.php";
$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$profile_photo = $_SESSION['photo'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Code Blaze</title>

  <link rel="stylesheet" href="assets/css/style_home.css" />
  <link rel="icon" type="image/x-icon" href="" />
</head>

<body>
  <!-- User Profile -->
  <div class="container_usercard">
    <div class="usercard_logout">
      <div class="usercard">
        <img src="assets/images/<?php echo $profile_photo; ?>" alt="Avatar" />
        <div class="usercard_info">
          <p class="usercard_name"><b>
              <?php echo $username; ?>
            </b></p>
          <p class="usercard_mail">
            <?php echo $email; ?>
          </p>
        </div>
      </div>
      <div class="button_logout">
        <a href="logout.php">LOGOUT</a></li>
      </div>
    </div>
  </div>

  <div class="container_pet_task">
    <!-- Pet -->
    <div class="container_pet">
      <div class="pet">
        <?php
        $sql = "SELECT * FROM tb_users LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id";
        $query = mysqli_query($conn, $sql);
        while ($petResult = mysqli_fetch_array($query)) {
          ?>
          <img class="pet_display_img" src="./assets/images/<?php echo $petResult['photo'] ?>" />
          <div class="pet_info">
            <p class="pet_name"><b>
                <?php echo $petResult['name']; ?>
              </b></p>
          </div>
        <?php } ?>
        <div class="pet_progress" id="completed_count">
          <p class="loading_text">loading . . . . . . . . . </p>
        </div>
      </div>
    </div>

    <!-- Task -->
    <div class="container_task">
      <div class="task_undone">
        <div class="title">
          <p class="your_task"><b>Your Task</b></p>
          <a href="add_task.php">
            <input class="button_add" type="submit" value="+" name="add" />
          </a>
        </div>
        <div class="task_active_list" id="active_tasks">
          <p class="loading_text">loading . . . . . . . . . </p>
        </div>
      </div>

      <div class="task_done">
        <div class="title">
          <p class="your_task"><b>Completed Task</b></p>
          <input class="button_more" type="submit" value=">" name="more" />
        </div>
        <div class="task_active_list" id="completed_tasks">
          <p class="loading_text">loading . . . . . . . . . </p>
        </div>
      </div>

      <!-- Script -->
      <script src="./assets/js/jquery-3.7.0.js"></script>
      <script src="./assets/js/script.js"></script>
      <script>
        $(document).ready(function () {
          get_data();
          completed_data();
          completed_count();
        });
      </script>
</body>

</html>