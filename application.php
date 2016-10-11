<?php

if(!isset($_GET['address'])) {
	echo "Error: E-mail address not set.";
	exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Merchant Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
	<div class="content" id="merchant_application">
		<h1>Merchant application</h1>
		<p>Please click the button below to download our <strong>PlatformPay Merchant Application Form</strong> and fill it accurately.</p>
		<form method="get" action="directives/Platformpay_Official_Merchant_Application_Form.doc">
			<button type="submit">Download Merchant Application Form</button>
		</form>
		<form method="POST" action="send-files.php" enctype="multipart/form-data">
			<p>Please upload your application form below after you have filled it. <strong>Please don't change the file name. Also file extension should stay as .doc - please don't save it in a different format.</strong></p>
			<input id="application_form" type="file" name="application_form" required/>
			<p>Please upload other documents below. You can find the list in the application form. They should be <strong>zipped into one single file whose name is documents.zip</strong>. Please make sure that they are complete and the files are appropriately named.</p>
			<input id="other_documents" type="file" name="other_documents" required/>
			<p style="display: none;">Your e-mail address: <input id="address" type="text" name="address" value="<?php if(!empty($_GET['address'])) echo $_GET['address']; ?>"></p>
			<p>Please click the send button below to send your application. You may want to recheck to ensure that nothing is missing.</p>
			<input id="merchant_application_submit" type="submit" value="Submit your application"/>
		</form>
	</div>
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>