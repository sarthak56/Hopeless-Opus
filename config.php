<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "qwerty123456";
$dbName = "opus";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(mysqli_connect_errno($conn)) {
    die("Contact organizers");
}
