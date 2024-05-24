<?php
if($_SERVER['HTTP_HOST'] == 'localhost'){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "marked";
} else {
    $servername = "sql205.infinityfree.com";
    $username = "if0_36596144";
    $password = "Om015107";
    $dbname = "if0_36596144_marked";
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
require_once('checkLogin.php');
?>