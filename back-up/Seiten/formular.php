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

if(isset($_POST['submit'])) {
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['age']) && !empty($_POST['address'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $address = $_POST['address'];

        $query = "insert into form(name,email,age,address) values('$name', '$email', '$age', '$address')";
        $run = mysqli_query($conn, $query) or die (mysqli_error());

        if($run) {
            echo "Form submitted successfully";
        }
        else {
            echo "Form not submitted";
        }

    }
}






