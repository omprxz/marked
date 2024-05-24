#!/bin/bash

# Create and populate addResultType.php
cat <<'EOF' > actions/addResultType.php
<?php
require('conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resultType = $_POST['result_type'];
    $query = "INSERT INTO result_types (type) VALUES ('$resultType')";
    if (mysqli_query($conn, $query)) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>
EOF

# Create and populate updateResultType.php
cat <<'EOF' > actions/updateResultType.php
<?php
require('conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $resultType = $_POST['result_type'];
    $query = "UPDATE result_types SET type='$resultType' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>
EOF

# Create and populate deleteResultType.php
cat <<'EOF' > actions/deleteResultType.php
<?php
require('conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $query = "DELETE FROM result_types WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>
EOF

# Create and populate getResultTypes.php
cat <<'EOF' > actions/getResultTypes.php
<?php
require('conn.php');
$resultTypeQuery = "SELECT id, type FROM result_types";
$resultTypeResult = mysqli_query($conn, $resultTypeQuery);
while ($row = mysqli_fetch_assoc($resultTypeResult)) {
    echo "<li class='list-group-item d-flex justify-content-between align-items-center' data-id='".$row['id']."'>".$row['type']."
    <p class='mb-0 d-flex gap-4'>
        <i class='fas fa-pencil edit' data-id='".$row['id']."'></i>
        <i class='fas fa-trash-alt delete' data-id='".$row['id']."'></i>
    </p>
    </li>";
}
?>
EOF

echo "Files created and populated successfully."