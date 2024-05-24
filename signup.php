<?php
session_start();
if(isset($_SESSION['userid'])){
  header('Location: profile.php');
}
require 'actions/conn.php';
$msg = "";
$status = "";
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $branch = isset($_POST['branch']) ? $_POST['branch'] : '';
  $semester = isset($_POST['semester']) ? $_POST['semester'] : '';
  $roll = isset($_POST['roll']) ? $_POST['roll'] : '';
  $pass = $_POST['pass'];
  $pass = password_hash($pass, PASSWORD_DEFAULT);
  $sql = "SELECT * FROM users WHERE email='$email'";

  if ($role == "student") {
    if (empty($branch) || empty($semester) || empty($roll)) {
      $msg = "All fields are required!";
      $status = "danger";
    } else {
      $sql = "SELECT * FROM users WHERE email='$email' OR (role='student' AND branch='$branch' AND semester='$semester' AND roll='$roll')";
      $sql2 = "INSERT INTO users (name, email, role, branch, semester, roll, pass) VALUES ('$name', '$email', '$role', '$branch', '$semester', '$roll', '$pass')";
    }
  } else {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $sql2 = "INSERT INTO users (name, email, role, pass) VALUES ('$name', '$email', '$role', '$pass')";
  }

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $msg = "Email or User already exists!";
    $status = "danger";
  } else {

    if (!empty($sql2)) {
      if (mysqli_query($conn, $sql2)) {
        $msg = "Account Created! Proceed to <a href='login.php'>Login</a>";
        $status = "success";
      } else {
        $msg = "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        $status = "danger";
      }
    }
  }
}

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
<style>
  .student-dets-div{
  display: none;
}
</style>

</head>

<body>
  <?php include 'nav.php'; ?>
<div class="container-fluid ">
<h1 class="text-center mt-3">Register</h1>
<!--
            name
            email
            branch
            semester
            roll
            pass
         -->
<form action="" method="post" class="m-4 ">
<?php if (!empty($msg)){ ?>
      <div class="alert alert-<?php echo $status; ?>">
        <?php echo $msg; ?>
      </div>
<?php } ?>
<div class="form-floating mb-3">
<input type="text" name="name" class="form-control" id="name" placeholder="" value="<?php echo $name; ?>" required>
<label for="name">Name</label>
</div>
<div class="form-floating mb-3">
<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo $email; ?>" required>
<label for="email">Email address</label>
</div>
<div class="mb-3">
<select name="role" class="form-select" id="role" aria-label="Role" required>
<option selected value="" disabled>Select Role</option>
<option value="student">Student</option>
<option value="faculty">Faculty</option>
</select>
</div>
<div class="mb-3 student-dets-div ">
<select name="branch" class="form-select student-dets-input" id="branch" aria-label="Branch">
<option selected value="" disabled>Select Branch</option>
<option value="CSE">Computer Science and Engineering (CSE)</option>
<option value="CE">Civil Engineering (CE)</option>
<option value="ECE">Electronics and Communication Engineering (ECE)</option>
<option value="EE">Electrical Engineering (EE)</option>
<option value="ME">Mechanical Engineering (ME)</option>
<option value="AUTOM">Automobile Engineering (AUTOM)</option>
</select>
</div>
<div class="mb-3 student-dets-div ">
<select name="semester" class="form-select student-dets-input" id="semester" value="" aria-label="Semester">
<option selected value="" disabled>Select Semester</option>
<option value="1">1st Semester</option>
<option value="2">2nd Semester</option>
<option value="3">3rd Semester</option>
<option value="4">4th Semester</option>
<option value="5">5th Semester</option>
<option value="6">6th Semester</option>
</select>
</div>
<div class="form-floating mb-3 student-dets-div ">
<input type="number" name="roll" class="form-control student-dets-input" id="roll" placeholder="">
<label for="roll">Roll</label>
</div>

<div class="input-group mb-3">
<input type="password" name="pass" class="form-control" id="pass" placeholder="Password"
aria-label="Password" required>
<label for="pass" class="visually-hidden">Password</label>
<button class="btn btn-outline-secondary toggle-password" type="button" data-target="pass">
<i class="fas fa-eye"></i>
</button>
</div>
<div class="mt-4 text-center">
<button name="submit" class="btn btn-outline-success register">Register</button>
</div>
<div class="text-center my-3">Already have an account? <a href="login.php" class="link-primary">Log in</a></div>
</form>
</div>

<script>
$(".register").click(function() {
e.preventDefault()
alert("ok")
})
</script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="eruda.js" type="text/javascript" charset="utf-8"></script>
<script src="components/signup.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>