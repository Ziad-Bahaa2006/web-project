<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mysite_db";
   
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die(" failed" . $conn->connect_error);
}

  
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$sql = "INSERT INTO users (username, email, password, phone) VALUES ('$username', '$email', '$hashed_password', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>conectted!</h2>";
} else {
    echo "error : " . $conn->error;
}

$conn->close();
?>
