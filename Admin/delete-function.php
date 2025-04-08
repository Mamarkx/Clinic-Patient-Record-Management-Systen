<?php
include("../database/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);     
        $stmt = $conn->prepare("DELETE FROM patient_tbl WHERE ID = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            throw new Exception("Error executing delete statement");
        }
        
        $stmt->close();
    } catch (Exception $e) {
        error_log("Error deleting patient: " . $e->getMessage());
        echo "error";
    }
} else {
    echo "invalid request";
}

$conn->close();
?>