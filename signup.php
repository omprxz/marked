<?php
require 'actions/conn.php';

if (isset($_POST['submit'])) {
  // check if both passwords are same, check if email id not used and if user with same roll number branch and semester not exists
  
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        type="text/css" media="all" />
    <link
        href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.2-web/css/all.min.css"
        rel="stylesheet">

</head>

<body>
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
          <div class="alert alert-success">
            Account Created!
          </div>
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="name" placeholder="" required>
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                <label for="email">Email address</label>
            </div>
            <div class="mb-3">
                <select name="role" class="form-select" id="role" aria-label="Role" required>
                    <option selected disabled>Select Role</option>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                </select>
            </div>      
            <div class="mb-3 student-dets-div d-none ">
                <select name="branch" class="form-select" id="branch" aria-label="Branch" required>
                    <option selected>Select Branch</option>
                    <option value="CSE">Computer Science and Engineering (CSE)</option>
                    <option value="CE">Civil Engineering (CE)</option>
                    <option value="ECE">Electronics and Communication Engineering (ECE)</option>
                    <option value="EE">Electrical Engineering (EE)</option>
                    <option value="ME">Mechanical Engineering (ME)</option>
                    <option value="AUTOM">Automobile Engineering (AUTOM)</option>
                </select>
            </div>      
            <div class="mb-3 student-dets-div d-none ">
                <select name="semester" class="form-select" id="semester" aria-label="Semester" required>
                    <option selected>Select Semester</option>
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                    <option value="3">3rd Semester</option>
                    <option value="4">4th Semester</option>
                    <option value="5">5th Semester</option>
                    <option value="6">6th Semester</option>
                </select>
            </div>
            <div class="form-floating mb-3 student-dets-div d-none ">
                <input type="number" name="roll" class="form-control" id="roll" placeholder="" required>
                <label for="roll">Roll</label>
            </div>
            
            <div class="input-group mb-3">
                <input type="password" name="pass" class="form-control" id="pass" placeholder="Password"
                    aria-label="Password">
                <label for="pass" class="visually-hidden">Password</label>
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="pass">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="pass2" class="form-control" id="pass2" placeholder="Confirm Password"
                    aria-label="Confirm Password">
                <label for="pass2" class="visually-hidden">Confirm Password</label>
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="pass2">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="mt-4 text-center">
                <button name="submit" class="btn btn-outline-success register">Register</button>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" type="text/javascript"
        charset="utf-8"></script>
    <script src="components/signup.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>