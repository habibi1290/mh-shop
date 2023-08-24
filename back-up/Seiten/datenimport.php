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
    die("Connection failed:" . mysqli_connect_error());
}


$fh = fopen($_FILES["upcsv"]["tmp_name"], "r");


if  ($fh===false) {
    exit("Error opening uploaded CSV file");
}

while(($row = fgetcsv($fh)) !== false) {
    try {
        $stmt = $conn->prepare("INSERT INTO `user`(`user_name`, `user_email` ) VALUES ('$row[0]', '$row[1]')");
        $stmt ->execute();
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

fclose($fh);
echo "DONE!";

