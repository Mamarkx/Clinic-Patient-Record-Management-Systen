<?php
include("../database/connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $bday = $_POST['bday'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];
        $purpose = $_POST['purpose'];

   
    

        $stmt = $conn->prepare("UPDATE patient_tbl SET 
            Name = ?, 
            Age = ?, 
            Gender = ?, 
            Status = ?, 
            Phone = ?, 
            Bday = ?, 
            Address = ?, 
            Purpose = ? 
            WHERE ID = ?");

        $stmt->bind_param("sissssssi", 
            $name, 
            $age, 
            $gender, 
            $status, 
            $phone, 
            $bday, 
            $address, 
            $purpose, 
            $id
        );

        if ($stmt->execute()) {
            echo "success";
        } else {
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        error_log("Error updating patient: " . $e->getMessage());
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>