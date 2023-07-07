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
if (empty($task_date)) {
    $task_date = "";
}

$task_desc = $_POST['task_desc'];
if (empty($task_desc)) {
    $task_desc = "No Desc";
}

$priority_id = $_POST['priority_id'];
if (empty($priority_id)) {
    $priority_id = "1";
}

$category_id = $_POST['category_id'];
if (empty($category_id)) {
    $category_id = "0";
}

if ($act == "set_done") {
    $sql = "update tb_tasks set status_id=2 where id='$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "uncheck") {
    $sql = "update tb_tasks set status_id=1 where id='$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "deleteTask") {
    $sql = "DELETE FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "saveTask") {
    $sql_insert = "INSERT INTO tb_tasks 
    (task_name, task_date, task_time, task_desc, priority_id, user_id, category_id, reminder_id, status_id) VALUES 
    ('$task_name','$task_date','$task_time','$task_desc','$priority_id','$user_id','$category_id','1','1')";
    $run_query_check = mysqli_query($conn, $sql_insert);

} else if ($act == "editTask") {

    $sql = "select * from tb_tasks where id='$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $task_name = $result['task_name'];

    echo "|" . $task_name . "|";

} else if ($act == "completed_count") {
    $sql = "DELETE FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $sql = "SELECT COUNT(*) AS completed_count FROM tb_tasks WHERE user_id='$user_id' AND status_id=2";
    $query = mysqli_query($conn, $sql);
    while ($taskCompleted = mysqli_fetch_array($query)) {
        ?>
                            <p class="pet_complete">
                            <?php echo $taskCompleted['completed_count']; ?> Task Completed
                            </p>
                            <p class="pet_percent">
                            <?php echo $taskCompleted['completed_count'] * 100; ?> xp
                            </p>
                        <?php }

} else if ($act == "loading") {
    $sql = "select t.*, c.name, c.photo from tb_tasks t left join tb_categories c on t.category_id = c.id where user_id='$user_id' and status_id=1 order by task_date asc";
    $query = mysqli_query($conn, $sql);
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
                                            <span class="checkmark"></span>
                                        </label>
                                        <div class="task_checkbox">
                                            <button type="button" id="delete_undone<?php echo $task_id; ?>"
                                                onclick="delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                                <p>Delete</p>
                                            </button>
                                            <button type="button" id="edit_undone<?php echo $task_id; ?>" class="button_edit" value="Edit"
                                                onclick="edit_task(<?php echo $task_id; ?>)">
                                                <p>Edit</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php
    }
} else if ($act == "completed") {
    $sql = "select t.*, c.name, c.photo from tb_tasks t left join tb_categories c on t.category_id = c.id where user_id='$user_id' and status_id=2";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'];
        $task_deadtime = $result['task_time'];
        $task_desc = $result['task_desc'];
        $category = $result['category_name'];
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
                                                <?php echo $task_deadline; ?> -
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
                                                    <p>Delete</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
    }
}
?>