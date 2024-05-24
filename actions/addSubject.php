<?php
require('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    
    $checkQuery = "SELECT COUNT(*) as count FROM subjects WHERE subject = '$subject'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);
    
    if ($row['count'] > 0) {
        echo json_encode(array("status" => "error", "message" => "Subject already exists"));
        exit;
    }
    
    $query = "INSERT INTO subjects (subject) VALUES ('$subject')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(array("status" => "success", "message" => "Subject added successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error adding subject"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>