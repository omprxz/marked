<?php
require('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $subject = $_POST['subject'];
    
    // Check if the new subject already exists
    $checkQuery = "SELECT COUNT(*) as count FROM subjects WHERE subject = '$subject' AND id != '$id'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);
    
    if ($row['count'] > 0) {
        echo json_encode(array("status" => "error", "message" => "New subject already exists"));
        exit;
    }
    
    $query = "UPDATE subjects SET subject='$subject' WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(array("status" => "success", "message" => "Subject updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating subject"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>