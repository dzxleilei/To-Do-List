<?php
session_start();
include "config/connection.php";

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM tb_users WHERE email = '$email' AND password = '$password'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            $status = $row['status'];
            $id = $row['id'];
            $username = $row['username'];
            $photo = $row['photo'];
            $fullname = $row['fullname'];

            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['photo'] = $photo;
            $_SESSION['fullname'] = $fullname;

            if ($status == 1) {
                // User is an admin (status = 1)
                ?>
                <script>
                    alert("Hello Admin");
                    location.href = "admin/admin.php";
                </script>
                <?php
                exit();
            } else if ($status == 0) {
                // User is not an admin (status = 0)
                ?>
                    <script>
                        location.href = "home.php";
                    </script>
                    <?php
            }

        } else {
            ?>
            <script>
                alert("Invalid Data");
                location.href = "login.php";
            </script>
<?php
        }
    }
}
?>