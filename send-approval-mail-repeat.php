<?php

session_start();

require('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tblname = 'mails';
$sql_query = "SELECT * FROM $tblname WHERE mailtype='approved'";
$result = $conn->query( $sql_query );

if ($result->num_rows > 0) {
	
    // output data of each row
    while($row = $result->fetch_assoc()) {

		$clientid = $row['clientid'];
		$period = $row['period'];
		$remaining = $row['remaining'];
		$tblname2 = 'clients';
		$sql_query = "SELECT * FROM $tblname2 WHERE id=$clientid";
		$result2 = $conn->query( $sql_query );
		$row2 = $result2->fetch_assoc();
		
		if($row2['status'] == 'approved') {
			
			if($row['remaining'] == 0) {
				
				/*
				require_once('PHPMailer/class.phpmailer.php');
				require_once('PHPMailer/class.smtp.php');

				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->CharSet = 'UTF-8';

				$mail->SMTPAuth   = true;
				$mail->Port       = 26;
				$mail->Username   = "abc@xyz.com";
				$mail->Password   = "password";

				$mail->From      = 'PlatformPay';
				$mail->FromName  = '';
				$mail->Subject   = 'Reminder';
				$mail->Body      = $row['template'];
				$mail->AddAddress( $row2['email'] );
				*/
				
				$message = wordwrap($row['template'], 70);

				$headers = 'From: paymentedge@paymentedge.com' . "\r\n" .
					'Reply-To: paymentedge@paymentedge.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($row2['email'], 'Reminder', $message, $headers);
				
				/*
				if(!$mail->Send()) {
						echo 'Message could not be sent. ';
						echo 'Mailer Error: ' . $mail->ErrorInfo;
						exit;
				}
				*/
				
				$sql_query = "UPDATE $tblname SET remaining=$period WHERE id=$clientid AND mailtype='intro'";
				$conn->query( $sql_query );
				
				$sql_query = "UPDATE $tblname SET remaining=$period WHERE id=$clientid AND mailtype='approved'";
				$conn->query( $sql_query );
				
			} else {
				
				$remaining = $remaining - 1;
				$sql_query = "UPDATE $tblname SET remaining=$remaining WHERE id=$clientid AND mailtype='approved'";
				$conn->query( $sql_query );
				
			}
			
		}		
		
	}
	
} else {
    
	echo "0 results";

}

$conn->close();

?>