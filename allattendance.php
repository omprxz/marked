<?php
require('actions/vars.php');
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
} else {
    $sUserId = $_SESSION['userid'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Attendance</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/components/libs/font-awesome-pro/css/all.min.css" rel="stylesheet">
  <style>
    .table-container {
      overflow-x: auto;
    }
    .table {
      width: max-content;
    }
    .table th, .table td {
      white-space: nowrap; 
      min-width: 120px; 
    }
    .thead-fixed th {
      position: sticky;
      top: 0;
      background-color: #fff; 
      z-index: 1;
    }
    .tableAtt tbody td:first-child,
    .tableAtt thead th:first-child {
      position: sticky;
      left: 0;
      z-index: 2;
      border-right: 1px solid #ccc; 
    }
    .download-icon {
      cursor: pointer;
    }
  </style>
</head>
<body>
  <script src="eruda.js" type="text/javascript" charset="utf-8"></script>
  <?php include 'nav.php'; ?>
  <?php 
  $roleQ = "SELECT role from users where id = '$sUserId' limit 1";
  $roleE = mysqli_fetch_assoc(mysqli_query($conn, $roleQ));
  $role = $roleE['role'];
  if($role != 'faculty'){ ?>
    <div class="alert alert-danger m-4">
      This page is only for faculties.
    </div>
  <?php } else {
    $totalWorkingDays = getTotalWorkingDays($startAttendenceDate); ?>
    <div class="container">
      <h1 class="fw-bold mt-3 text-center">All Attendance</h1>
      <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
          <div>
              <p class="mb-2">Today's Date: <?php echo date("Y-m-d"); ?></p>
              <p>Total Working Days: <?php echo $totalWorkingDays; ?></p>
          </div>
          <div class="d-flex gap-1">
            <a href="actions/download_attendance.php?download=pdf" class="btn btn-sm btn-primary float-end">PDF <i class="fas fa-download"></i>
            </a>
            <a href="actions/download_attendance.php?download=csv" class="btn btn-sm btn-primary float-end">CSV <i class="fas fa-download"></i>
            </a>
          </div>
      </div>
      <div class="table-container" style="overflow-x: auto;">
        <table id="attendanceTable" class="table table-primary table-bordered table-hover p-0 tableAtt">
          <thead class="thead-fixed">
            <tr>
              <th>Name</th>
              <th>Roll No</th>
              <th>Branch</th>
              <th>Semester</th>
              <?php
                $startDate = new DateTime($startAttendenceDate);
                $endDate = new DateTime(); 
                $interval = new DateInterval('P1D');
                $period = new DatePeriod($startDate, $interval, $endDate);
                foreach ($period as $date) {
                  if ($date->format('N') != 7) { 
                    echo '<th>' . $date->format('Y-m-d') . '</th>';
                  }
                }
              ?>
              <th>Total Present</th>
              <th>Percentage</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT users.id, users.name, users.roll, users.branch, users.semester, COUNT(attendance.id) AS total_present,
                      (COUNT(attendance.id) / $totalWorkingDays) * 100 AS percentage
                      FROM users
                      LEFT JOIN attendance ON users.id = attendance.s_id
                      WHERE users.role != 'faculty' 
                      GROUP BY users.id";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['roll'] . "</td>";
                  echo "<td>" . $row['branch'] . "</td>";
                  echo "<td>" . $row['semester']; 
                  foreach ($period as $date) {
                    if ($date->format('N') != 7) { 
                      $formattedDate = $date->format('Y-m-d');
                      echo "<td>";
                      $sql_attendance = "SELECT * FROM attendance WHERE s_id = " . $row['id'] . " AND DATE(date) = '$formattedDate'";
                      $result_attendance = $conn->query($sql_attendance);
                      if ($result_attendance->num_rows > 0) {
                        echo "P";
                      } else {
                        echo "A";
                      }
                      echo "</td>";
                    }
                  }
                  echo "<td>" . $row['total_present'] . "</td>";
                  echo "<td>" . round($row['percentage'], 2) . "%</td>";
                  echo "</tr>";
                }
              }
              $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php } ?>
</body>
</html>

<?php
function getTotalWorkingDays($startAttendenceDate) {
  $startDate = new DateTime($startAttendenceDate);
  $endDate = new DateTime(); 
  $interval = new DateInterval('P1D');
  $period = new DatePeriod($startDate, $interval, $endDate);
  $workingDays = 0;
  foreach ($period as $date) {
    if ($date->format('N') != 7) { 
      $workingDays++;
    }
  }
  return $workingDays;
}
?>