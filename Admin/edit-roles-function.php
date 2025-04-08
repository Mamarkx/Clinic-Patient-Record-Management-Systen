<?php
include("../database/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $birthday = $_POST['bday'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['pass'];

    $query = "UPDATE users SET Username = ?, Name = ?, Email = ?, Roles = ?, Birthday = ?";
    $params = [$username, $name, $email, $role, $birthday];
    $types = "sssss";

    if (!empty($password)) {
        $query .= ", password = ?";
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $params[] = $hashedPassword;
        $types .= "s";
    }

    $query .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
