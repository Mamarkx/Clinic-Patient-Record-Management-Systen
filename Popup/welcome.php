<?php
session_start();

if (!isset($_SESSION["login_success"])) {
    header("Location: ../Admin/index.php"); 
    exit();
}

$user_role = $_SESSION["user_role"];

unset($_SESSION["login_success"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

    <style>
        .my-swal-popup {
            height: 300px;
        }
    </style>
    <script src='sweetalert2.js'></script>
</head>
<body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Successful',
            text: 'Welcome <?php echo $user_role; ?>',
            showConfirmButton: false,
            timer: 1500,
            heightAuto: false,
            customClass: {
                popup: 'my-swal-popup'
            }
        });

        setTimeout(function() {
            window.location.href = '../Admin/dashboard.php';
        }, 1500);
    </script>
</body>
</html>

