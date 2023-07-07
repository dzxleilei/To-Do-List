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
        $sql = "SELECT * FROM tb_users LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id WHERE tb_users.id='$user_id'";
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
          <a href="#divAdd">
            <!-- <a href="add_task.php"> -->
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
    </div>
  </div>

  <?php include "frm_task.php"; ?>

  <!-- Update Task -->
  <?php
  if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $sql = "SELECT * FROM tb_tasks WHERE id = '$task_id'";
    $result = mysqli_query($conn, $sql);
    $task = mysqli_fetch_assoc($result);

    // Periksa apakah ada data
    if ($task) {
      $task_name = $task['task_name'];
      $task_date = $task['task_date'];
      $task_time = $task['task_time'];
      $task_desc = $task['task_desc'];
      $priority_id = $task['priority_id'];
      $category_id = $task['category_id'];
      $reminder_id = $task['reminder_id'];
      $status_id = $task['status_id'];

      $old_priority_id = $priority_id;
      $old_category_id = $category_id;
      $old_reminder_id = $reminder_id;
      $old_status_id = $status_id;
    }
  }
  ?>

  <div class="overlayUpdate" id="divUpdate">
    <div class="wrapper_update_task">
      <p class="title_update_task"><b>Edit Task</b></p>
      <a href="#" class="close">&times;</a>
      <div class="content_update_task">
        <div class="container_update_task">
          <h3>Title</h3>
          <div class="inputForm">
            <input class="textField" type="text" value="<?php echo $task_name; ?>" name="edit_task_name"
              id="edit_task_name" placeholder="Add Task Title..." required />
          </div>
          <h3>Description</h3>
          <div class="inputForm">
            <input class="textField" type="text" value="<?php echo $task_desc; ?>" name="task_desc" id="task_desc"
              placeholder="Add Task Description..." />
          </div>
          <div class="inputForm">
            <h3>Category</h3>
            <div class="customSelect">
              <select name="category_id" id="category_id" value="<?php echo $old_category_id; ?>">
                <option value="" selected disabled>Select Category</option>
                <option value="1">Study</option>
                <option value="2">Sport</option>
                <option value="3">Meeting</option>
                <option value="4">Medic</option>
              </select>
              <span class="arrow"></span>
            </div>
          </div>
          <div class="inputForm">
            <h3>Priority</h3>
            <div class="customSelect">
              <select name="priority_id" id="priority_id" value="<?php echo $old_priority_id; ?>">
                <option value="" selected disabled>Select Priority</option>
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
              </select>
              <span class="arrow"></span>
            </div>
          </div>
          <div class="inputForm_date">
            <div class="inputForm">
              <h3>Due Date</h3>
              <div class="inputForm">
                <input class="textField" type="datetime-local" name="task_date" id="task_date"
                  value="<?php echo $task_date; ?>">
              </div>
            </div>
          </div>
          <div class="button_update_tasks">
            <center>
              <td colspan="2"><input class="button_add_task" type="submit" value="Update Task" name="submit"></td>
            </center>
          </div>
        </div>
      </div>
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