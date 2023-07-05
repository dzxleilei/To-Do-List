<?php
include "config/security.php";
include "config/connection.php";
$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$photo = $_SESSION['photo'];
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
        <img src="assets/images/<?php echo $photo; ?>" alt="Avatar" />
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
        <img src="assets/images/pet.png" alt="png" />
        <div class="pet_info">
          <p class="pet_name"><b>Rocky</b></p>
          <div class="pet_progress">
            <p class="pet_complete">30 Tasks Completed</p>
            <p class="pet_percent">30%</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Task -->
    <div class="container_task">
      <div class="task_undone">
        <div class="title">
          <p class="your_task"><b>Your Task</b></p>
          <input class="button_add" type="submit" value="+" name="add" />
        </div>

        <div class="container_undone">
          <div class="taskcard">
            <div class="category">
              <img src="assets/images/Category=Study.png" alt="Study" />
            </div>
            <div class="task_1">
              <div class="task_title"><b>Membuat to do list</b></div>
              <div class="task_time">21:00</div>
              <div class="task_desc">Penugasan Code Blaze</div>
            </div>
          </div>
          <input type="checkbox" id="check" name="check" value="" />
        </div>

        <div class="container_undone">
          <div class="taskcard">
            <div class="category">
              <img src="assets/images/Category=Study.png" alt="Study" />
            </div>
            <div class="task_1">
              <div class="task_title"><b>Membuat to do list</b></div>
              <div class="task_time">21:00</div>
              <div class="task_desc">Penugasan Code Blaze</div>
            </div>
          </div>
          <input type="checkbox" id="check" name="check" value="" />
        </div>
      </div>

      <div class="task_done">
        <div class="title">
          <p class="your_task"><b>Completed Task</b></p>
          <input class="button_more" type="submit" value=">" name="more" />
        </div>

        <div class="container_done">
          <div class="taskcard">
            <div class="category">
              <img src="assets/images/Category=Study.png" alt="Study" />
            </div>
            <div class="task_1">
              <div class="task_title"><b>Membuat to do list</b></div>
              <div class="task_time">21:00</div>
              <div class="task_desc">Penugasan Code Blaze</div>
            </div>
          </div>
          <input type="checkbox" id="check" name="check" value="" />
        </div>

        <div class="container_done">
          <div class="taskcard">
            <div class="category">
              <img src="assets/images/Category=Study.png" alt="Study" />
            </div>
            <div class="task_1">
              <div class="task_title"><b>Membuat to do list</b></div>
              <div class="task_time">21:00</div>
              <div class="task_desc">Penugasan Code Blaze</div>
            </div>
          </div>
          <input type="checkbox" id="check" name="check" value="" />
        </div>
      </div>

    </div>
  </div>
  </div>

  <!-- Script -->
  <script src=""></script>
</body>

</html>