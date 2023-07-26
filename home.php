<?php
include "config/security.php";
include "config/connection.php";
$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Code Blaze</title>

  <link rel="stylesheet" href="assets/css/style_home.css" />
  <link href="assets/select2/css/select2.min.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="" />
</head>

<body>
  <!-- User Profile -->
  <div class="container_usercard">
    <div class="usercard_logout">
      <div class="usercard">
        <a href="profile.php"><img src="assets/images/<?php echo $profile_photo; ?>" alt="Avatar" /></a>
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
        <div class="pet_content" id="pet_phases">
          <p class="loading_text">loading . . . . . . . . . </p>
        </div>
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
          <div class="button_filter_add">
            <a href="report.php">
              <div class="button_filter"><i class="fa-solid fa-filter"></i></div>
            </a>
            <a href="#divAdd">
              <input class="button_add" type="submit" value="+" name="add" />
            </a>
          </div>
        </div>
        <div class="task_active_list" id="active_tasks">
          <p class="loading_text">loading . . . . . . . . . </p>
        </div>
      </div>

      <div class="task_done">
        <div class="title">
          <p class="your_task"><b>Completed Task</b></p>
          <!-- <input class="button_more" type="submit" value=">" name="more" /> -->
        </div>
        <div class="task_active_list" id="completed_tasks">
          <p class="loading_text">loading . . . . . . . . . </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Task -->
  <!-- Update Task -->
  <?php include "frm_task.php"; ?>

  <!-- Reminder -->
  <div id="alarmTrigger"></div>

  <!-- Script -->
  <script src="./assets/js/jquery-3.7.0.js"></script>
  <script src="./assets/js/script.js"></script>
  <script src="./assets/select2/js/select2.min.js"></script>
  <script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function () {
      get_data();
      completed_data();
      completed_count();
      pet_phases();
      alarm_trigger();
    });
    $(document).ready(function () {
      $('.js-example-basic-multiple').select2();
    });
    setTimeout(function () {
      location.reload();
    }, 60000);
  </script>
</body>

</html>