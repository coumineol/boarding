<?php

session_start();

/*
if ( $_SESSION['loggedin'] == false ) {
	header("Location: login.php");
	exit();
}
*/

require('database.php');

$tblname = "clients";

$newstatus = $_POST['status'];
$id = $_POST['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql_query = "UPDATE $tblname SET status='$newstatus' WHERE id='$id'";
$conn->query( $sql_query );

if( isset( $_SESSION['username'] ) ) {
	$username = $_SESSION['username'];
	$sql_query = "UPDATE $tblname SET lasteditor='$username' WHERE id='$id'";
	$conn->query( $sql_query );
}

$conn->close();

if ( $newstatus == 'approved' ) {
	header('Location: approved.php?id='.$id);
	exit;
}

$location = 'Location: application-data.php?id='.$id;
header( $location );
exit();

?>