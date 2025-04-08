<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../database/connection.php");

if (!isset($_SESSION['user_role']) || !isset($_SESSION['user_id'])) {
    session_destroy();
    header("Location: ../404.php");
    exit();
}


$userRole = $_SESSION['user_role'];
$userID = $_SESSION['user_id'];


$allowedRoles = ['Doctor', 'User', 'Admin', 'Nurse'];


if (!in_array($userRole, $allowedRoles)) {

    session_destroy();
    header("Location: ../404.php");
    exit();
}
?>
