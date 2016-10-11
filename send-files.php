<?php

/*
$target_dir = "documents/";
$target_file_1 = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file_2 = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
*/

if (isset($_POST['address'])) {
	
	require('database.php');

	$tblname = "clients";
	
	$address = $_POST['address'];
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql_query = "SELECT * FROM $tblname WHERE email='$address'";
	$result = mysqli_query($conn, $sql_query);
	
	if( $result->num_rows != 1 ) { 
		$result->free();
		$conn->close();
		exit;
	}
	
	$result->free();
	$conn->close();
	
	require_once('PHPMailer/class.phpmailer.php');
	require_once('PHPMailer/class.smtp.php');

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->CharSet = 'UTF-8';
	
	// $mail->SMTPAuth   = true;
	// $mail->Port       = 26;
	// $mail->Username   = "abc@xyz.com";
	// $mail->Password   = "password";
	
	$mail->From      = 'def@xyz.com';
	$mail->FromName  = 'Your Name';
	$mail->Subject   = 'Message Subject';
	$mail->Body      = '';
	$mail->AddAddress( $_POST['address'] );
	$mail->AddAddress( 'archive@platformpay.com' );
	$mail->AddAddress( 'applications@platformpay.com' );

	$file_to_attach_1 = fopen($_FILES['application_form']['tmp_name'], 'r');
	$file_to_attach_2 = fopen($_FILES['other_documents']['tmp_name'], 'r');

	$mail->AddAttachment( $file_to_attach_1 );
	$mail->AddAttachment( $file_to_attach_2 );
	
	//////////////////////////////
	$newdir = 'documents/'.$_POST['address']; 
	mkdir($newdir, 0777, true);
	
	$info = pathinfo( $_FILES['application_form']['name'] );
	$ext = $info['extension'];
	$newname = "Platformpay_Official_Merchant_Application_Form.".$ext; 

	$target = $newdir.'/'.$newname;
	move_uploaded_file( $_FILES['application_form']['tmp_name'], $target );
	
	$info = pathinfo( $_FILES['other_documents']['name'] );
	$ext = $info['extension'];
	$newname = "documents.zip"; 

	$target = $newdir.'/'.$newname;
	move_uploaded_file( $_FILES['other_documents']['tmp_name'], $target );
	//////////////////////////////

	if(!$mail->Send()) {
		echo 'Message could not be sent. ';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql_query = "UPDATE $tblname SET status='applied' WHERE id='$id'";
	$conn->query( $sql_query );	
	
} else {
	exit;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>MerAppResp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="content" id="merappresp">
	<?php

		echo "Your application has been sent. We will get in contact with you shortly.";

	?>
	</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

