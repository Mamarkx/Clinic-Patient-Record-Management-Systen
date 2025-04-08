<?php
// logout.php in Admin/includes/logout.php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie if it exists
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/'); // Set cookie expiration in the past
}

// Destroy the session
session_destroy();

// Redirect to login page with a success message
header("Location: ../../index.php");
exit();
?>
