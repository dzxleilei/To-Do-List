<?php
include "config/security.php";
include "config/connection.php";

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

$user_id = $_SESSION['id'];

$sql_insert = "INSERT INTO tb_tasks 
    (task_name, task_date, task_time, task_desc, priority_id, user_id, category_id, reminder_id, status_id) VALUES 
    ('$task_name','$task_date','$task_time','$task_desc','$priority_id','$user_id','$category_id','1','1')";
$run_query_check = mysqli_query($conn, $sql_insert);
if (!$run_query_check) {
    die('Query error: ' . mysqli_error($conn));
} else {
    ?>
    <script>
        alert("New Task Added!");
    </script>
    <?php
    header("Refresh:0.1; url=home.php");
}
?>