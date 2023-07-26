<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act'];
$id = $_POST['id'];

$task_name = $_POST['task_name'];


$task_date = $_POST['task_date'];
if (empty($task_date)) {
    $task_date = "date(Y-m-d)";
}

$task_time = $_POST['task_time'];
if (empty($task_time)) {
    $task_time = "";
}

$task_desc = $_POST['task_desc'];
if (empty($task_desc)) {
    $task_desc = "No Desc";
}

$priority_id = $_POST['priority_id'];
if (empty($priority_id)) {
    $priority_id = "0";
}

$category_id = $_POST['category_id'];
if (empty($category_id)) {
    $category_id = "0";
}

$reminder_number = $_POST['reminder_number'];
if (empty($reminder_number)) {
    $reminder_number = "";
}

$reminder_unit = $_POST['reminder_unit'];
if (empty($reminder_unit)) {
    $reminder_unit = "";
}

$collaborators = $_POST['collaborators'];
if (empty($collaborators)) {
    $collaborators = "";
}

if ($act == "set_done") {
    $sql = "update tb_tasks set status_id=2 where id='$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "uncheck") {
    $sql = "update tb_tasks set status_id=1 where id='$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "deleteTask") {
    $sqlcollab = "DELETE FROM tb_collaborators WHERE task_id='$id'";
    $querycollab = mysqli_query($conn, $sqlcollab);
    $sqlreminder = "DELETE FROM tb_reminders WHERE task_id='$id'";
    $queryreminder = mysqli_query($conn, $sqlreminder);
    $sql = "DELETE FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "saveTask") {
    $exec = false;
    $timestamp = strtotime("$task_date $task_time");
    $reminder_time = 60;

    if ($reminder_unit != "") {
        if ($reminder_unit == 1) {
            $reminder_time *= $reminder_number;
        } else if ($reminder_unit == 2) {
            $reminder_time *= $reminder_number * 60;
        } else if ($reminder_unit == 3) {
            $reminder_time *= $reminder_number * 1440;
        }
        $exec = true;
    }

    $sql_insert = "INSERT INTO tb_tasks 
    (task_name, task_date, task_time, task_desc, priority_id, user_id, category_id, status_id) VALUES 
    ('$task_name','$task_date','$task_time','$task_desc','$priority_id','$user_id','$category_id','1')";
    $run_query_check = mysqli_query($conn, $sql_insert);

    $latest_id = mysqli_insert_id($conn);

    if ($exec) {
        $reminder_timestamp = $timestamp - $reminder_time;
        $reminder_date = date("Y-m-d", $reminder_timestamp);
        $reminder_time = date("H:i", $reminder_timestamp);

        //save reminder
        $sqlRemind = "INSERT INTO tb_reminders (task_id, reminder_time, reminder_date) VALUES ('$latest_id', '$reminder_time', '$reminder_date')";
        $queryRemind = mysqli_query($conn, $sqlRemind) or die($sqlRemind);
    }

    if ($collaborators != "") {
        if (is_array($collaborators)) {
            // Hitung Array
            $arrayCollaboratorsLength = count($collaborators);

            // Mengambil Id task terakhir
            $sqlGetTaskId = "SELECT id FROM tb_tasks ORDER BY id DESC LIMIT 1";
            $queryGetTaskId = mysqli_query($conn, $sqlGetTaskId);
            $resultGetTaskId = mysqli_fetch_array($queryGetTaskId);
            $task_id = $resultGetTaskId['id'];

            for ($i = 0; $i < $arrayCollaboratorsLength; $i++) {

                $sqlCheckProfile = "SELECT id, username FROM tb_users WHERE id = '$collaborators[$i]'";
                $queryCheckProfile = mysqli_query($conn, $sqlCheckProfile);
                $resultCheckProfile = mysqli_fetch_array($queryCheckProfile);
                $username = $resultCheckProfile['username'];
                $collab_id = $resultCheckProfile['id'];

                // Menambahkan data ke tabel kolaborator berdasarkan id
                $sqlCollaborators = "INSERT INTO tb_collaborators (task_id, collab_id, added_by) VALUES ('$task_id', '$collab_id', '$user_id')";
                mysqli_query($conn, $sqlCollaborators);

                //menampilkan task kesetiap kolabolator
                $sqlShowTask = "SELECT task_id FROM tb_collaborators WHERE collab_id = '$collaborator[$i]'";
            }
        }
    }

} else if ($act == "alarmTrigger") {
    date_default_timezone_set('Asia/Jakarta');
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:00', time());

    // Query to check for reminders
    $sql_check_reminder = "SELECT tb_reminders.*, tb_tasks.* FROM tb_reminders LEFT JOIN tb_tasks ON tb_reminders.task_id = tb_tasks.id WHERE reminder_date = '$currentDate' AND reminder_time = '$currentTime' AND tb_tasks.user_id = '$user_id' AND tb_tasks.status_id = 1";
    $query_check_reminder = mysqli_query($conn, $sql_check_reminder);
    $row = mysqli_num_rows($query_check_reminder);
    $result = mysqli_fetch_array($query_check_reminder);
    if ($row > 0) {
        // There is a reminder that matches the current time
        ?>
                        <div class="reminder_title">
                            <p>Reminder Set:
                            <?php echo $result['task_name'];
                            echo $result['task_date'];
                            echo $result['task_time']; ?>
                            </p>
                            <audio autoplay>
                                <source src="assets/sounds/alarm.mp3" type="audio/mpeg">
                            </audio>
                        </div>
                        <?php
    } else {
        echo "Reminder not set";
    }

} else if ($act == "editTask") {
    $sql = "SELECT * FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $task_id = $result['id'];
    $task_name = $result['task_name'];
    $task_desc = $result['task_desc'];
    $task_date = $result['task_date'];
    $task_time = $result['task_time'];
    $priority_id = $result['priority_id'];
    $category_id = $result['category_id'];
    // $reminder_id = $result['reminder_id'];
    echo "|" . $task_name . "|" . $task_desc . "|" . $category_id . "|" . $priority_id . "|" . $task_date . "|" . $task_time . "|" . $task_id . "|";

} else if ($act == "updateTask") {
    $task_id = $_POST['id'];
    // $reminder_id = $_POST['reminder_id'];
    // $status_id = $_POST['status_id'];
    $sql_update = "UPDATE tb_tasks SET task_name = '$task_name', task_date = '$task_date', task_time = '$task_time', task_desc = '$task_desc', priority_id = '$priority_id', user_id = '$user_id', category_id = '$category_id' WHERE id = '$task_id'";
    $run_query_check = mysqli_query($conn, $sql_update);

} else if ($act == "pet_phases") {
    $sql1 = "SELECT pet_id FROM tb_users WHERE id = '$user_id'";
    $query1 = mysqli_query($conn, $sql1);
    $result1 = mysqli_fetch_array($query1);
    $pet_id = $result1['pet_id'];

    $sql2 = "UPDATE tb_users SET pet_phases = (SELECT tb_pet_phases.id FROM tb_pet_phases LEFT JOIN tb_pets ON tb_pet_phases.pet_id = tb_pets.id WHERE xp >= min_xp AND xp <= max_xp AND pet_id = $pet_id LIMIT 1) WHERE id = '$user_id'";
    $query2 = mysqli_query($conn, $sql2);

    $sql3 = "SELECT tb_pet_phases.photo, tb_pet_phases.name FROM tb_pet_phases LEFT JOIN tb_users ON tb_pet_phases.id = tb_users.pet_phases LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id WHERE tb_users.id='$user_id' && xp>=min_xp && xp<=max_xp;";
    $query3 = mysqli_query($conn, $sql3);
    $update_pet = mysqli_fetch_array($query3);
    $pet_image = $update_pet['photo'];
    $pet_name = $update_pet['name'];

    ?>
                                <img class="pet_display_img" src="./assets/images/<?php echo $pet_image; ?>" />
                                <div class="pet_info">
                                    <p class="pet_name"><b>
                                        <?php echo $pet_name; ?>
                                        </b></p>
                                </div>
                                <?php

} else if ($act == "completed_count") {
    $sql = "DELETE FROM tb_tasks WHERE id = '$id'";
    $queryDelete = mysqli_query($conn, $sql);

    $sql = "SELECT COUNT(*) AS completed_count FROM tb_tasks WHERE user_id='$user_id' AND status_id=2";
    $queryCount = mysqli_query($conn, $sql);
    while ($taskCompleted = mysqli_fetch_array($queryCount)) {
        $completedCount = $taskCompleted['completed_count'];
        $xp = $completedCount * 10;

        $sqlUpdateXP = "UPDATE tb_users SET xp = $xp WHERE id='$user_id'";
        $queryUpdateXP = mysqli_query($conn, $sqlUpdateXP);

        $sqlGetTotalScore = "SELECT xp FROM tb_users WHERE id='$user_id'";
        $queryGetTotalScore = mysqli_query($conn, $sqlGetTotalScore);
        $totalScore = mysqli_fetch_array($queryGetTotalScore);
        ?>
                                        <p class="pet_complete">
                                        <?php echo $completedCount; ?> Task Completed
                                        </p>
                                        <p class="pet_percent">
                                        <?php echo $totalScore['xp']; ?> xp
                                        </p>
                                        <?php
    }

} else if ($act == "loading") {
    $sql = "SELECT t.*, c.name, c.photo FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id LEFT JOIN tb_collaborators a ON t.id = a.task_id WHERE (user_id='$user_id' OR collab_id='$user_id') AND status_id=1 ORDER BY task_date ASC";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 0) {
        echo "No data";
    } else {
        while ($result = mysqli_fetch_array($query)) {
            $task_id = $result['id'];
            $task_title = $result['task_name'];
            $task_deadline = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
            $task_deadtime = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
            $task_desc = $result['task_desc'];
            $category = $result['name'];
            $category_img = $result['photo'];
            ?>
                                                <div class="container_undone">
                                                    <div class="taskcard">
                                                        <div class="category">
                                                            <img src="assets/images/<?php echo $category_img ?>" />
                                                        </div>
                                                        <div class="task_info">
                                                            <div class="task_title"><b>
                                                                <?php echo $task_title; ?>
                                                                </b></div>
                                                            <div class="task_time">
                                                                <?php
                                                                if ($task_deadline < date('Y-m-d')) {
                                                                    $font_color = "red";
                                                                } else {
                                                                    $font_color = "black";
                                                                }
                                                                ?>
                                                                <font color="<?php echo $font_color; ?>"> <?php echo $task_deadline; ?></font>
                                                            <?php echo $task_deadtime; ?>
                                                            </div>
                                                            <div class="task_desc">
                                                            <?php echo $task_desc; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="checkbox_delete_edit">
                                                        <label class="container_checkbox">
                                                            <input type="checkbox" class="tick" id="undone<?php echo $task_id; ?>"
                                                                onclick="check_task(<?php echo $task_id; ?>)" />
                                                            <span class="checkmark">
                                                                <!-- <i class="fa-solid fa-check"></i> -->
                                                            </span>
                                                        </label>
                                                        <div class="task_checkbox">
                                                            <button type="button" id="edit_undone<?php echo $task_id; ?>" class="button_edit" value="Edit"
                                                                onclick="edit_task(<?php echo $task_id; ?>)">
                                                                <i class="fa-solid fa-pencil"></i>
                                                            </button>
                                                            <button type="button" id="delete_undone<?php echo $task_id; ?>"
                                                                onclick="delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
    }

} else if ($act == "filter") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $filter_status = $_POST['filter_status'];

    $sql = "select t.*, c.name, c.photo from tb_tasks t left join tb_categories c on t.category_id = c.id where user_id='$user_id'";

    if ($filter_status !== "all") {
        $sql .= " and status_id ='$filter_status'";
    }

    if ($start_date !== '' && $end_date !== '') {
        $sql .= " and (t.task_date between date('$start_date') and date('$end_date'))";
    } else if ($start_date == '' && $end_date !== '') {
        $sql .= " and (t.task_date between date('0000-00-00') and date('$end_date'))";
    } else if ($start_date !== '' && $end_date == '') {
        $sql .= " and (t.task_date between date('$start_date') and NULL)";
    }

    $sql .= " order by t.task_date asc";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'];
        $task_desc = $result['task_desc'];
        $user_id = $result['user_id'];
        $category = $result['name'];
        $category_img = $result['photo'];
        ?>
                                                <div class="task_main">
                                                    <div class="task_picture">
                                                        <img src="assets/images/<?php echo $category_img; ?>">
                                                    </div>
                                                    <div class="task_desc">
                                                        <p class="text1 black bold">
                                                        <?php echo $task_title; ?>
                                                        </p>
                                                        <div class="task_time">
                                                            <!-- <img src="assets/picture/time.png"> -->
                                                            <p class="text6 black regular">
                                                            <?php echo $task_deadline; ?>
                                                            </p>
                                                        </div>
                                                        <p class="text2 black regular">
                                                        <?php echo $task_desc; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php
    }

} else if ($act == "completed") {
    $sql = "SELECT t.*, c.name, c.photo FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id LEFT JOIN tb_collaborators a ON t.id = a.task_id WHERE (user_id='$user_id' OR collab_id='$user_id') AND status_id=2 ORDER BY task_date ASC";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 0) {
        echo "No data";
    } else {
        while ($result = mysqli_fetch_array($query)) {
            $task_id = $result['id'];
            $task_title = $result['task_name'];
            $task_deadline = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
            $task_deadtime = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
            $task_desc = $result['task_desc'];
            $category = $result['name'];
            $category_img = $result['photo'];
            ?>
                                                        <div class=" container_done">
                                                            <div class="taskcard">
                                                                <div class="category">
                                                                    <img src="assets/images/<?php echo $category_img ?>" />
                                                                </div>
                                                                <div class="task_1">
                                                                    <div class="task_title"><b>
                                                                        <?php echo $task_title; ?>
                                                                        </b></div>
                                                                    <div class="task_time">
                                                                    <?php echo $task_deadline; ?>
                                                                    <?php echo $task_deadtime; ?>
                                                                    </div>
                                                                    <div class="task_desc">
                                                                    <?php echo $task_desc; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="checkbox_delete_edit">
                                                                <label class="container_checkbox">
                                                                    <input type="checkbox" class="tick" id="done<?php echo $task_id; ?>"
                                                                        onclick="uncheck_task(<?php echo $task_id; ?>)" checked />
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <div class="task_checkbox">
                                                                    <button type="button" id="delete_done<?php echo $task_id; ?>" onclick="delete_task(<?php echo $task_id; ?>)"
                                                                        class="button_delete" value="Delete">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
        }
    }
}
?>