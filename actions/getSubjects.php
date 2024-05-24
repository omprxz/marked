<?php
require('conn.php');
$subjectQuery = "SELECT id, subject FROM subjects";
$subjectResult = mysqli_query($conn, $subjectQuery);
while ($row = mysqli_fetch_assoc($subjectResult)) {
    echo "<li class='list-group-item d-flex justify-content-between align-items-center' data-id='".$row['id']."'>".$row['subject']."
    <p class='mb-0 d-flex gap-4'>
        <i class='fas fa-pencil edit' data-id='".$row['id']."'></i>
        <i class='fas fa-trash-alt delete' data-id='".$row['id']."'></i>
    </p>
    </li>";
}
?>