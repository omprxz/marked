<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
} else {
    $sUserId = $_SESSION['userid'];
}
require('actions/vars.php');
require_once 'actions/conn.php';

$currentDate = date('Y-m-d');
$query = "SELECT * FROM attendance WHERE s_id = '$sUserId' AND DATE(date) = '$currentDate'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    $attNotMarked = true;
}


$query = "SELECT COUNT(*) AS totalAttendance FROM attendance WHERE s_id = '$sUserId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalAttendance = $row['totalAttendance'];

$attStartDate = '2024-05-18';
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

$query = "SELECT COUNT(*) AS presentDays FROM attendance WHERE s_id = '$sUserId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$presentDays = $row['presentDays'];
$absentDays = $workingDays - $presentDays;

$attendancePercentage = ($totalAttendance / $workingDays) * 100;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" type="text/css" media="all" />
    <link href="/components/libs/font-awesome-pro/css/all.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'nav.php'; ?>
  <?php 
  $roleQ = "SELECT role from users where id = '$sUserId' limit 1";
  $roleE = mysqli_fetch_assoc(mysqli_query($conn, $roleQ));
  $role = $roleE['role'];
  if($role == 'student'){
  ?>
    <div class="container pt-3">
        <h1 class="text-center mb-4">Attendance</h1>
        <?php if ($attNotMarked): ?>
    <div class="alert alert-warning alert-dismissible fade show px-3" role="alert">
        Attendance not marked today. <a href="markatt.php" class="alert-link">Mark here <i class="fas fa-hand-point-right"></i></a>
    </div>
<?php endif; ?>
        <div class="text-center mb-4">
          <p class="">Date: <?php echo $startAttendenceDate.' -> '.date("Y-m-d"); ?></p>
    <p class="badge bg-dark p-2">Total Working Days: <?php echo $workingDays; ?></p>
    <div class="d-flex justify-content-around gap-3">
        <div class="flex-fill badge bg-primary p-2">Present: <?php echo $presentDays; ?></div>
        <div class="flex-fill badge bg-success p-2">Percentage: <?php echo number_format($attendancePercentage, 2) . '%'; ?></div>
        <div class="flex-fill badge bg-danger p-2">Absent: <?php echo $absentDays; ?></div>
    </div>
</div>
        <table class="table table-hover text-center">
    <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM attendance WHERE s_id = '$sUserId'";
        $result = mysqli_query($conn, $query);
        $attendanceCount = mysqli_num_rows($result);
        if ($attendanceCount == 0) {
            echo '<tr><td colspan="2" class="text-center">No attendance record</td></tr>';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . date('Y-m-d', strtotime($row['date'])) . '</td>';
                echo '<td>' . date('h:i A', strtotime($row['date'])) . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
    </div>
<?php
}else{
?>
<div class="alert alert-danger m-4">
  This page is only for students.
</div>
<?php
}
?>
    
</body>

</html>