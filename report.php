<?php
include "config/security.php";
include "config/connection.php";
$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$profile_photo = $_SESSION['photo'];

$sql_status = "SELECT * FROM tb_status";
$query = mysqli_query($conn, $sql_status);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Code Blaze</title>

    <link rel="stylesheet" href="assets/css/style_home.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="" />
</head>

<body class="body">
    <!-- <body> -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <button onclick="javascript:location.href='home.php'" class="logout">BACK</button>
            </div>
        </div>
        <form method="POST">
            <br>
            <div class="row">
                <div class="col-12">
                    <input type="date" name="from_date" class="from_date form-control" id="from_date" placeholder="from"
                        style="max-width: 25%;float: left;" value="">
                    <span style="float:left;">s/d</span>
                    <input type="date" name="to_date" class="to_date form-control" id="to_date" placeholder="to"
                        style="max-width: 25%;float: left;" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <span>Status </span>
                    <select name="status" class="status form-select" id="status" style="max-width: 25%;">
                        <option value="all">All</option>
                        <?php
                        while ($num1 = mysqli_fetch_array($query)) {
                            $id_status = $num1['id'];
                            $status = $num1['status'];
                            ?>
                            <option id="<?php echo $status; ?>" name="<?php echo $status; ?>"
                                value="<?php echo $id_status; ?>"><?php echo $status; ?></option>
                            <?php
                        }
                        ?>
                        <option value="none">None</option>
                    </select>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-12">
                    <input type="button" name="view_result" class="view_result logout" id="view_result" value="VIEW"
                        style="width:25%;" onclick="vw_result()">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="todolist">
                    <br>
                    <div id="tdl" style="display:block; height: 200px;"></div>
                    <div id="report_result">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="assets/js/jquery-3.7.0.js"></script>
    <script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/user.js"></script>

    <script>
        $(document).ready(function () {
        });
    </script>
</body>

</html>