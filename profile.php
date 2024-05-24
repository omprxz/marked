<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
} else {
    $sUserId = $_SESSION['userid'];
}

require('actions/conn.php');

$msg="";
$status="";
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];
    $roll = $_POST['roll'];

    $sql = "UPDATE users SET name='$name', email='$email', branch='$branch', semester='$semester', roll='$roll' WHERE id=$sUserId";

    if (mysqli_query($conn, $sql)) {
        $msg = "Profile updated";
        $status = "success";
    } else {
        $msg = "Error updating record: " . mysqli_error($conn);
        $status = "danger";
    }
}


$sql = "SELECT * FROM users WHERE id = $sUserId";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
   $userNotFound = 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          type="text/css" media="all"/>
    <link href="/components/libs/font-awesome-pro/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  
  <?php include 'nav.php'; ?>
  
<div class="container-fluid">
    <h1 class="text-center mt-3">Profile</h1>
    <?php if (!empty($msg)){ ?>
      <div class="alert m-4 alert-<?php echo $status; ?>">
        <?php echo $msg; ?>
      </div>
    <?php } ?>
    <div class="details">
      <?php 
      if($userNotFound == 1){
        echo '<div class="text-center">';
        echo '<p>User not found.</p>';
        echo '</div>';
        exit();
      }
      ?>
        <form method="post" class="m-4">
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" required id="name" placeholder="" disabled
                       value="<?php echo htmlspecialchars($user['name']); ?>">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" required id="email" placeholder="name@example.com" disabled
                       value="<?php echo htmlspecialchars($user['email']); ?>">
                <label for="email">Email address</label>
            </div>
            <?php
            if($user['role']=='student'){
            ?>
            <div class="mb-3">
                <select name="branch" class="form-select" id="branch" aria-label="Branch" required disabled>
                    <option value="" selected disabled>Select Branch</option>
                    <option value="CSE" <?php echo ($user['branch'] == 'CSE') ? 'selected' : ''; ?>>Computer Science and Engineering (CSE)</option>
                    <option value="CE" <?php echo ($user['branch'] == 'CE') ? 'selected' : ''; ?>>Civil Engineering (CE)</option>
                    <option value="ECE" <?php echo ($user['branch'] == 'ECE') ? 'selected' : ''; ?>>Electronics and Communication Engineering (ECE)</option>
                    <option value="EE" <?php echo ($user['branch'] == 'EE') ? 'selected' : ''; ?>>Electrical Engineering (EE)</option>
                    <option value="ME" <?php echo ($user['branch'] == 'ME') ? 'selected' : ''; ?>>Mechanical Engineering (ME)</option>
                    <option value="AUTOM" <?php echo ($user['branch'] == 'AUTOM') ? 'selected' : ''; ?>>Automobile Engineering (AUTOM)</option>
                </select>
            </div>
            <div class="mb-3">
                <select name="semester" class="form-select" required id="semester" aria-label="Semester" disabled>
                    <option value="" selected disabled>Select Semester</option>
                    <option value="1" <?php echo ($user['semester'] == '1') ? 'selected' : ''; ?>>1st Semester</option>
                    <option value="2" <?php echo ($user['semester'] == '2') ? 'selected' : ''; ?>>2nd Semester</option>
                    <option value="3" <?php echo ($user['semester'] == '3') ? 'selected' : ''; ?>>3rd Semester</option>
                    <option value="4" <?php echo ($user['semester'] == '4') ? 'selected' : ''; ?>>4th Semester</option>
                    <option value="5" <?php echo ($user['semester'] == '5') ? 'selected' : ''; ?>>5th Semester</option>
                    <option value="6" <?php echo ($user['semester'] == '6') ? 'selected' : ''; ?>>6th Semester</option>
                </select>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="roll" class="form-control" disabled required id="roll" placeholder=""
                       value="<?php echo htmlspecialchars($user['roll']); ?>">
                <label for="roll">Roll</label>
            </div>
            <?php } ?>
            <div class="mt-4 text-center d-flex justify-content-center gap-4">
                <button class="btn btn-outline-primary edit" type="button">Edit Profile</button>
                <button class="btn btn-outline-secondary d-none cancel" type="button">Cancel</button>
                <button class="btn btn-outline-success d-none update" name="update" type="submit">Update</button>
            </div>
        </form>
    </div>
    <div class="mt-4 d-flex justify-content-center gap-4">
                <a class="btn btn-warning text-nowrap" href="forgot.php">Forgot Password</a>
                <button class="btn btn-danger text-nowrap" data-bs-toggle="modal" data-bs-target="#changePasswordDiv">Change Password</button>
            </div>
    <div class="mt-4 d-flex justify-content-center gap-4">
                <button class="btn btn-dark logoutBtn text-nowrap">Logout</button>
            </div>
            
     <div class="modal fade" id="changePasswordDiv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="changePasswordForm" class="modal-body changePasswordForm">
        <div class="mt-2" style="width:100%;">
        <label for="name" class="fw-bold">Current Password: </label>
        <input class="form-control" type="password" placeholder="Current Password" id="currentPass" required>
      </div>
        <div class="mt-2" style="width:100%;">
        <label for="name" class="fw-bold">New Password: </label>
        <input class="form-control" type="password" placeholder="New Password" id="newPass1" required>
      </div>
        <div class="mt-2" style="width:100%;">
        <label for="name" class="fw-bold">Confirm New Password: </label>
        <input class="form-control" type="text" placeholder="Confirm New Password" id="newPass2" required>
      </div>
      </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-success changePassword">Change</button>
      </div>
    </div>
  </div>
</div>
</div>

<script src="eruda.js" type="text/javascript" charset="utf-8"></script>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="components/profile.js" type="text/javascript" charset="utf-8"></script>
<script>
  $('.edit').on('click', function(){
    $('#name, #email, #branch, #semester, #roll').prop('disabled', false);
    $('.edit').addClass('d-none');
    $('.cancel, .update').removeClass('d-none');
});

$('.cancel').on('click', function(){
    $('#name').val("<?php echo htmlspecialchars($user['name']); ?>");
    $('#email').val("<?php echo htmlspecialchars($user['email']); ?>");
    $('#branch').val("<?php echo htmlspecialchars($user['branch']); ?>");
    $('#semester').val("<?php echo htmlspecialchars($user['semester']); ?>");
    $('#roll').val("<?php echo htmlspecialchars($user['roll']); ?>");
    
    $('#name, #email, #branch, #semester, #roll').prop('disabled', true);
    
    $('.cancel, .update').addClass('d-none');
    $('.edit').removeClass('d-none');
});
</script>
</body>
</html>