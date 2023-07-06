<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act'];
$id = $_POST['id'];

if ($act == "set_done") {
    $sql = "update tb_tasks set status_id=2 where id='$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "uncheck") {
    $sql = "update tb_tasks set status_id=1 where id='$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "deleteTask") {
    $sql = "DELETE FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

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
                    <p class="pet_percent">xp</p>
                <?php }

} else if ($act == "loading") {
    $sql = "select t.*, c.name, c.photo from tb_tasks t left join tb_categories c on t.category_id = c.id where user_id='$user_id' and status_id=1";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'];
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
                                    <?php echo $task_deadline; ?>
                                    </div>
                                    <div class="task_desc">
                                    <?php echo $task_desc; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox_delete_edit">
                                <input type="checkbox" id="undone<?php echo $task_id; ?>" onclick="check_task(<?php echo $task_id; ?>)" />
                                <div class="task_checkbox">
                                    <button type="button" id="delete_undone<?php echo $task_id; ?>"
                                        onclick="delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                        <p>Delete</p>
                                    </button>
                                    <button type="button" id="edit_undone<?php echo $task_id; ?>" onclick="edit_task(<?php echo $task_id; ?>)"
                                        class="button_edit" value="Edit">
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
        $task_desc = $result['task_desc'];
        $category = $result['category_name'];
        $category_img = $result['photo'];
        ?>
                            <div class="container_done">
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
                                        </div>
                                        <div class="task_desc">
                                        <?php echo $task_desc; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkbox_delete_edit">
                                    <input type="checkbox" id="done<?php echo $task_id; ?>" onclick="uncheck_task(<?php echo $task_id; ?>)"
                                        checked />
                                    <div class="task_checkbox">
                                        <button type="button" id="delete_undone<?php echo $task_id; ?>"
                                            onclick="delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                            <p>Delete</p>
                                        </button>
                                        <button type="button" id="edit_undone<?php echo $task_id; ?>" onclick="edit_task(<?php echo $task_id; ?>)"
                                            class="button_edit" value="Edit">
                                            <p>Edit</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <?php
    }
}
?>