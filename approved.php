<?php

session_start();

$clientid = $_GET['id'];

/*
if ( $_SESSION['loggedin'] == false ) {
	header("Location: login.php");
	exit();
}
*/

require('database.php');

$tblname = "mails";

$conn = new mysqli($servername, $username, $password, $dbname);
$sql_query = "SELECT * FROM $tblname WHERE clientid=0 AND mailtype='approved'";
$result = $conn->query( $sql_query );
$row = $result->fetch_array( MYSQLI_ASSOC );

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Approval</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
	<div class="content" id="introduction">
		<h1>Send approval mail</h1>
		<form method="post" action="send-approval-mail.php">
			<textarea id="mailbody" type="text" name="mailbody" rows="50" cols="100"><?php echo $row['template']; ?></textarea>
			<p style="margin-top: 30px;">Period: <input id="period" type="text" name="period"> days</p>
			<input id="clientid" type="text" name="clientid" value="<?php echo $clientid; ?>" style="display: none;"></p>
			<button type="submit" style="display: block; margin: 0 auto; margin-top: 20px;">Send</button>
		</form>
		<p style="text-align: center;"><a href="login-success.php">Go back to main page</a></p>
		<p style="text-align: center;"><a href="dashboard.php">Go back to dashboard</a></p>
    </div>
	<script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>