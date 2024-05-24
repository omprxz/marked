<?php
session_start();
require 'conn.php';
require('vars.php');

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

if (!isset($_SESSION['userid'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$userId = $_SESSION['userid'];

$currentDate = date('Y-m-d');
$query = "SELECT * FROM attendance WHERE s_id = '$userId' AND DATE(date) = '$currentDate'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Today\'s attendance has been already marked']);
    exit();
}

if (!isset($_POST['location']) || !isset($_POST['location']['latitude']) || !isset($_POST['location']['longitude'])) {
    echo json_encode(['status' => 'error', 'message' => 'User location not provided']);
    exit();
}

$userLat = $_POST['location']['latitude'];
$userLon = $_POST['location']['longitude'];

$collegeLat = 25.6305705;
$collegeLon = 85.1033881;

$distance = distance($userLat, $userLon, $collegeLat, $collegeLon, 'K') * 1000;

if ($distance > $startAttendenceDate) {
    echo json_encode(['status' => 'error', 'message' => 'You are not in the college']);
    exit();
}

$userIP = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO attendance (s_id, s_lat, s_long, clg_lat, clg_long, ip, date) VALUES ('$userId', '$userLat', '$userLon', '$collegeLat', '$collegeLon', '$userIP', '$date')";

if (mysqli_query($conn,$sql)) {
    echo json_encode(['status' => 'success', 'message' => 'Attendance marked']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to mark attendance']);
}

mysqli_close($conn);
?>