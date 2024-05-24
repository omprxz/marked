<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
} else {
    $sUserId = $_SESSION['userid'];
}
require('actions/conn.php');

$currentDate = date('Y-m-d');
$query = "SELECT * FROM attendance WHERE s_id = '$sUserId' AND DATE(date) = '$currentDate'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $attFormStyle='d-none';
    $attMarkedStyle='';
} else {
    $attFormStyle='';
    $attMarkedStyle='d-none';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>

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
    <div class="container-fluid">
        <h1 class="text-center mt-3">Mark Today Attendance</h1>

        <div class="text-center">
            <p class="text-center py-2 px-3 badge text-bg-danger">
                Attendance for <?php echo date("d F Y"); ?>
            </p>
        </div>

        <form id="attendanceForm" method="post" class="m-4 mt-3 <?php echo $attFormStyle; ?>" action="#">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="">
                <label for="name">Signature (Your Name)</label>
            </div>

            <div class="location-div d-flex flex-column align-items-center justify-content-center text-center">
                <div id="location-info"></div>
            </div>

            <div class="mt-2 text-center">
                <button id="markAttendanceBtn" class="btn btn-outline-primary">Mark Present</button>
            </div>
        </form>

        <div class="alert alert-success fw-semibold mx-3 my-5 attMarked <?php echo $attMarkedStyle; ?>" role="alert">
            Today's attendance has been marked <i class="fas fa-circle-check"></i> <br>
            See You Tomorrow <i class="fas fa-hand-point-right"></i> <i class="fas fa-hand-point-left"></i>
        </div>
        <div class="text-center my-3">Want to view your attendance? <a href="viewatt.php" class="link-primary">View here</a></div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@codetrix-studio/crisp/crisp.min.js"></script>
    <script>
        $(document).ready(function() {
          const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter',
      Swal.stopTimer)
    toast.addEventListener('mouseleave',
      Swal.resumeTimer)
  }
})
            let locationData = {};

            function checkGeolocationSupport() {
                if (!navigator.geolocation) {
                    showAlert("Your browser doesn't support location permission. Please use a different browser.", "danger");
                }
            }

            function getCurrentPosition() {
                return new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(resolve, reject);
                });
            }

            async function requestLocation() {
                try {
                    const position = await getCurrentPosition();
                    locationData.latitude = position.coords.latitude;
                    locationData.longitude = position.coords.longitude;
                    console.log(locationData);
                    showAlert("Location granted", "success");
                } catch (err) {
                    showError(err);
                }
            }

            checkGeolocationSupport();

            function showError(err) {
                let message;
                switch (err.code) {
                    case 1:
                        message = "Location denied (compulsory). Please grant permission from site setting.";
                        break;
                    case 2:
                        message = "Unable to retrieve location information due to a network error.";
                        break;
                    case 3:
                        message = "The request to get user location timed out.";
                        break;
                    default:
                        message = "An unknown error occurred while trying to access your location.";
                }
                showAlert(message, "danger");
            }

            function showAlert(message, type) {
                var alertClass = "alert-" + type;
                var alertHtml = '<div class="alert ' + alertClass + ' fade show" role="alert">' +
                    message +
                    '</div>';
                $("#location-info").html(alertHtml);
            }

            function showLoader() {
                var loaderHtml = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
                $("#location-info").html(loaderHtml);
            }

            function hideLoader() {
                $("#location-info").html('');
            }

            $('#markAttendanceBtn').click(async function(e) {
                e.preventDefault();
                const sign = $('#name').val().trim();
                if (sign === "") {
                    showAlert("Signature is required.", "danger");
                    return;
                }
                $(this).prop('disabled', true);
                showLoader();

                await requestLocation();

                if (locationData.latitude && locationData.longitude) {
                    $.ajax({
                        url: 'actions/markAttAction.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            location: locationData,
                            sign: sign
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: response['status'],
                                title: response.message
                            });
                            if(response['status'] == 'success'){
                              $('#attendanceForm').addClass('d-none')
                              $('.attMarked').removeClass('d-none')
                            }
                        },
                        error: function(xhr, status, error) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error while marking attendance.'
                            });
                            console.error(error);
                        },
                        complete: function() {
                           // hideLoader();
                            $('#markAttendanceBtn').prop('disabled', false);
                        }
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: "Location permission required!"
                    });
                    //hideLoader();
                    $('#markAttendanceBtn').prop('disabled', false);
                }
            });
        });
    </script>
    <script src="eruda.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>