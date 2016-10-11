<?php

session_start();

if( !isset( $_POST['clientid'] ) ) {
	exit;
}

require('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);

$clientid = $_POST['clientid'];

$mailbody = mysqli_real_escape_string($conn, $_POST['mailbody']);

$period = $_POST['period'];

/*
if ( $_SESSION['loggedin'] == false ) {
	header("Location: login.php");
	exit();
}
*/

require('database.php');

$tblname = "clients";

$sql_query = "SELECT * FROM $tblname WHERE id='$clientid'";
$result = $conn->query( $sql_query );

if( $result->num_rows != 1 ) { 
		$result->free();
		$conn->close();
		echo 'Database error. ';
		exit;
}
$row = $result->fetch_array( MYSQLI_ASSOC );
$address = $row['email'];

/*

require_once('PHPMailer/class.phpmailer.php');
require_once('PHPMailer/class.smtp.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->SMTPAuth   = true;
$mail->Host       = "mail.yourdomain.com";
$mail->Port       = 26;
$mail->Username   = "abc@xyz.com";
$mail->Password   = "password";

$mail->From      = 'PlatformPay';
$mail->FromName  = '';
$mail->Subject   = 'PlatformPay Introduction';
$mail->Body      = $mailbody;
$mail->AddAddress( $address );

*/

$message = wordwrap($mailbody, 70);

$headers = 'From: paymentedge@paymentedge.com' . "\r\n" .
    'Reply-To: paymentedge@paymentedge.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($address, 'Approval', $message, $headers);

echo '123';

exit;

if(!$mail->Send()) {
		echo 'Message could not be sent. ';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
}

$sql_query = "UPDATE $tblname SET status='approved' WHERE id='$clientid'";
$conn->query( $sql_query );

$tblname = 'mails';

$sql_query = "INSERT INTO $tblname (clientid, template, mailtype, period, remaining) VALUES ($clientid, $mailbody, 'approved', $period, $period)";
$conn->query( $sql_query );

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Approval mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
	<div class="content">
		<h1>E-mail has been sent</h1>
	</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>