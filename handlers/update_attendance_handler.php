<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $student_name = $_POST['student_name'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE attendance SET student_name = ?, date = ?, status = ? WHERE id = ?");
    $stmt->bind_param("sssi", $student_name, $date, $status, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>