<?php
require_once 'conn.php';
require('vars.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minAttendance = $_POST['minAtt'];
    $maxAttendance = $_POST['maxAtt'];
    $marks = $_POST['marks'];
    $subjects = $_POST['subjects'];
    $resType = $_POST['resType'];

    if (empty($subjects) || empty($resType)) {
        echo json_encode(array("status" => "error", "message" => "All fields are required"));
        exit;
    }

    $sUserId = $_SESSION['userid'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $attStartDate = $startAttendenceDate;
    $attEndDate = date('Y-m-d');
    $workingDays = 0;
    $currentDate = new DateTime($attStartDate);
    $endDate = new DateTime($attEndDate);
    while ($currentDate <= $endDate) {
        if ($currentDate->format('N') != 7) {
            $workingDays++;
        }
        $currentDate->modify('+1 day');
    }

    $attendanceQuery = "SELECT s_id, 
                    COUNT(*) * 100 / $workingDays AS attendance_percentage 
                    FROM attendance 
                    GROUP BY s_id 
                    HAVING attendance_percentage >= $minAttendance 
                        AND attendance_percentage < $maxAttendance";

    $attendanceResult = mysqli_query($conn, $attendanceQuery);

    if (!$attendanceResult) {
        echo json_encode(array("status" => "error", "message" => "Error fetching attendance data"));
        exit;
    }

    while ($row = mysqli_fetch_assoc($attendanceResult)) {
        $studentId = $row['s_id'];
        $attendancePercentage = $row['attendance_percentage'];
        
        foreach ($subjects as $subjectId) {
            $checkMarksQuery = "SELECT * FROM marks WHERE s_id='$studentId' AND subject_id='$subjectId' AND resultType_id='$resType'";
            $checkMarksResult = mysqli_query($conn, $checkMarksQuery);
            
            if (mysqli_num_rows($checkMarksResult) > 0) {
                $updateMarksQuery = "UPDATE marks SET marks='$marks', f_id='$sUserId', ip='$ip' WHERE s_id='$studentId' AND subject_id='$subjectId' AND resultType_id='$resType'";
                $updateMarksResult = mysqli_query($conn, $updateMarksQuery);

                if (!$updateMarksResult) {
                    echo json_encode(array("status" => "error", "message" => "Error updating marks data"));
                    exit;
                }
            } else {
                $insertMarksQuery = "INSERT INTO marks (s_id, marks, subject_id, resultType_id, f_id, ip) 
                                    VALUES ('$studentId', '$marks', '$subjectId', '$resType', '$sUserId', '$ip')";
                $insertMarksResult = mysqli_query($conn, $insertMarksQuery);
                
                if (!$insertMarksResult) {
                    echo json_encode(array("status" => "error", "message" => "Error adding marks data"));
                    exit;
                }
            }
        }
    }

    echo json_encode(array("status" => "success", "message" => "Marks added successfully"));
    exit;
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
    exit;
}
?>