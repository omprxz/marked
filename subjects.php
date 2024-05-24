<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
} else {
    $sUserId = $_SESSION['userid'];
}
require('actions/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Manage Subjects</title>
  <link href="/components/libs/font-awesome-pro/css/all.min.css" rel="stylesheet">
</head>
<body>
   <?php include 'nav.php'; ?>
   <?php 
    $roleQ = "SELECT role from users where id = '$sUserId' limit 1";
    $roleE = mysqli_fetch_assoc(mysqli_query($conn, $roleQ));
    $role = $roleE['role'];
    if($role == 'faculty'){
  ?>
  <div class="container">
    <div class="text-center mt-4">
      <button type="button" id="addSubjectBtn" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Add Subject</button>
    </div>
    <ul class="list-group mt-4 mx-2 subjects-list">
      <?php
        $subjectQuery = "SELECT id, subject FROM subjects";
        $subjectResult = mysqli_query($conn, $subjectQuery);
        while($row = mysqli_fetch_assoc($subjectResult)) {
          echo "<li class='list-group-item d-flex justify-content-between align-items-center' data-id='".$row['id']."'>".$row['subject']."
          <p class='mb-0 d-flex gap-4'>
            <i class='fas fa-pencil edit' data-id='".$row['id']."'></i>
            <i class='fas fa-trash-alt delete' data-id='".$row['id']."'></i>
          </p>
          </li>";
        }
      ?>
    </ul>
  </div>
  <?php
    } else {
  ?>
  <div class="alert alert-danger m-4">
    This page is only for faculties.
  </div>
  <?php
    }
  ?>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    function loadSubjects() {
        $.ajax({
            url: 'actions/getSubjects.php',
            type: 'GET',
            success: function(response) {
                $('.subjects-list').html(response);
            }
        });
    }

    $('#addSubjectBtn').click(function() {
        Swal.fire({
            title: 'Add Subject',
            input: 'text',
            inputLabel: 'Subject Name',
            showCancelButton: true,
            confirmButtonText: 'Add',
            preConfirm: (subjectName) => {
                if (!subjectName) {
                    Swal.showValidationMessage('Subject name is required');
                }
                return subjectName;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'actions/addSubject.php',
                    type: 'POST',
            dataType: 'json',
                    data: { subject: result.value },
                    success: function(response) {
                        Toast.fire({title:response['message'], icon:response['status']});
                        loadSubjects();
                    }
                });
            }
        });
    });

    $(document).on('click', '.edit', function() {
        const subjectId = $(this).data('id');
        const subjectName = $(this).closest('li').text().trim();
        Swal.fire({
            title: 'Edit Subject',
            input: 'text',
            inputValue: subjectName,
            showCancelButton: true,
            confirmButtonText: 'Update',
            preConfirm: (newSubjectName) => {
                if (!newSubjectName) {
                    Swal.showValidationMessage('Subject name is required');
                }
                return newSubjectName;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'actions/updateSubject.php',
                    type: 'POST',
            dataType: 'json',
                    data: { id: subjectId, subject: result.value },
                    success: function(response) {
                       Toast.fire({title:response['message'], icon:response['status']});
                        loadSubjects();
                    }
                });
            }
        });
    });

    $(document).on('click', '.delete', function() {
        const subjectId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'actions/deleteSubject.php',
                    type: 'POST',
            dataType: 'json',
                    data: { id: subjectId },
                    success: function(response) {
                       Toast.fire({title:response['message'], icon:response['status']});
                        loadSubjects();
                    }
                });
            }
        });
    });

    loadSubjects();
});
</script>
</body>
</html>