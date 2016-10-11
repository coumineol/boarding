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

$newcomments = $_POST['comments'];
$id = $_POST['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql_query = "UPDATE $tblname SET comments='$newcomments' WHERE id='$id'";
$conn->query( $sql_query );

if( isset( $_SESSION['username'] ) ) {
	$username = $_SESSION['username'];
	$sql_query = "UPDATE $tblname SET lasteditor='$username' WHERE id='$id'";
	$conn->query( $sql_query );
}

$conn->close();

$location = 'Location: application-data.php?id='.$id;
header( $location );
exit();

?>