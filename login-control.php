<?php

require('database.php');

$tblname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// username and password sent from 
$username = $_POST['username']; 
$password = hash('sha512', $_POST['password']);
$pin = $_POST['pin']; 

// $sql_query = "SELECT * FROM $tblname WHERE username='$username' and password='$password' and pin='$pin'";
$sql_query = "SELECT * FROM $tblname WHERE username='$username' and password='$password' and pin='$pin'";
$result = mysqli_query($conn, $sql_query);

if($result->num_rows == 1){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
	$result->free();
	$conn->close();
	header('Location: login-success.php');
	exit();
} else {
	$result->free();
	$conn->close();
	header('Location: login.php');
	exit();
}

?>