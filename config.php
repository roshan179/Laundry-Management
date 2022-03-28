<?php

$server = "localhost";
$user = "root";
$pass = "albuspercival129*";
$database = "laundry";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>
