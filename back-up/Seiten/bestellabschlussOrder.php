<?php
// Verbindungsdaten für sql
$server = "ddev-whiteboard-db";
$username = "db";
$password = "db";
$dbname = "db";

// Create connection
$conn = mysqli_connect($server, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['passwd'];


$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($username);
$password = mysqli_real_escape_string($password);

$result = mysqli_query("select * from users where username = '$username' and password = '$password'")
or die ("Failed to query database" .mysqli_error());
$row = mysqli_fetch_array($result);
if($row['username'] == $username && $row['password'] == $password) {
    echo "kjaldjaldjalsk" .$row['username'];
}else {
    echo "Failed to Login";
}