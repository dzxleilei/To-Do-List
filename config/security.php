<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['emails'])) {
    ?>
    <script>
        alert("Please Login!");
        location.href = "login.php";
    </script>
    <?php
    exit(); // Add exit() after the redirect to stop further code execution
}
?>