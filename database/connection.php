<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$dbConfig = [
    'host' => 'localhost:3307',
    'user' => 'root',
    'pass' => '',
    'name' => 'patient'
];


$conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['pass'], $dbConfig['name']);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
