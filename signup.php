<?php
if (isset($_POST['submit'])) {
  
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" type="text/css" media="all" />
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.2-web/css/all.min.css">

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
                <input type="text" name="name" class="form-control" id="name" placeholder="">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="mb-3">
                <select name="branch" class="form-select" id="branch" aria-label="Branch">
                    <option selected>Select Branch</option>
                    <option value="CSE">Computer Science and Engineering (CSE)</option>
                    <option value="CE">Civil Engineering (CE)</option>
                    <option value="ECE">Electronics and Communication Engineering (ECE)</option>
                    <option value="EE">Electrical Engineering (EE)</option>
                    <option value="ME">Mechanical Engineering (ME)</option>
                    <option value="AUTOM">Automobile Engineering (AUTOM)</option>
                </select>
            </div>      
            <div class="mb-3">
                <select name="semester" class="form-select" id="semester" aria-label="Semester">
                    <option selected>Select Semester</option>
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                    <option value="3">3rd Semester</option>
                    <option value="4">4th Semester</option>
                    <option value="5">5th Semester</option>
                    <option value="6">6th Semester</option>
                </select>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="roll" class="form-control" id="roll" placeholder="">
                <label for="roll">Roll</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="password" name="pass" class="form-control" id="pass" placeholder="">
                <label for="pass">Password</label>
            </div>
            <div class="mt-4 text-center">
                <button name="submit" class="btn btn-outline-success ">Register</button>
            </div>
        </form>
    </div>


    <script src="eruda.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" type="text/javascript"
        charset="utf-8"></script>
</body>

</html>