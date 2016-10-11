<?php

session_start();

/*
if ( $_SESSION['loggedin'] == false ) {
	header("Location: login.php");
	exit();
}
*/

if ( !isset($_GET['id']) ) {
	header('Location: dashboard.php');
	exit();
}

require('database.php');

$tblname = "users";

// Create connection
$conn = new mysqli( $servername, $username, $password, $dbname );

if ( isset( $_SESSION['username'] ) ) {
	$username = $_SESSION['username']; // username of the logged-in user
}

$id = $_GET['id'];

$sql_query = "SELECT * FROM clients WHERE id=$id";
$result = $conn->query( $sql_query );

if( $result->num_rows != 1 ){
	$result->free();
	$conn->close();
	header('Location: dashboard.php');
	exit();
}

$row = $result->fetch_array( MYSQLI_ASSOC );

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Client details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="content" id="client_details">
		<div id="client_identity">
			<h1>Client details</h1>
			<dl>
				<dt>Website</dt>
				<dd>- <?php echo $row['website']; ?> -</dd>
				<dt>E-mail</dt>
				<dd>- <?php echo $row['email']; ?> -</dd>
				<dt>Status</dt>
				<dd>- <?php echo $row['status']; ?> -</dd>
				<dt>Comments</dt>
				<dd>- <?php echo $row['comments']; ?> -</dd>
				<dt>Last edited by</dt>
				<dd>- <?php echo $row['lasteditor']; ?> -</dd>
			</dl>
			<p style="text-align: center;"><a href="login-success.php">Go back to main page</a></p>
			<p style="text-align: center;"><a href="dashboard.php">Go back to dashboard</a></p>
		</div>
		</div>
			
		<div id="client_files">
			<form method="get" action="documents/<?php echo $row['email'];?>/Platformpay_Official_Merchant_Application_Form.doc">
				<button type="submit">Click here to download the Merchant Application Form filled by this client (if it exists)</button>
			</form>
			<form method="get" action="documents/<?php echo $row['email'];?>/documents.zip">
				<button type="submit">Click here to download the documents sent by this client (if they exist)</button>
			</form>
		</div>
		
		<div id="client_status">
			<p>You can change the status of the client here</p>
			<form method="post" action="change-status.php">
				<select name="status">
					<option value="created">created</option>
					<option value="introduced">introduced</option>
					<option value="applied">applied</option>
					<option value="approved">approved</option>
					<option value="integrating">integrating</option>
					<option value="installed">installed</option>
					<option value="selling">selling</option>
				</select>
				<input id="id" type="text" name="id" value="<?php echo $id; ?>" style="display: none;"></p>
				<button type="submit" style="display: block; margin: 0 auto; margin-top: 20px;">Change</button>
			</form>
		</div>
		
		<div id="client_comments">
			<p>You can add/edit comments for the client here</p>
			<form method="post" action="change-comments.php">
				<textarea id="comments" type="text" name="comments" rows="4" cols="70"></textarea>
				<input id="id" type="text" name="id" value="<?php echo $id; ?>" style="display: none;"></p>
				<button type="submit" style="display: block; margin: 0 auto; margin-top: 20px;">Change</button>
			</form>
		</div>
		
		<div id="client_send_intro">
			<p><a href="introduction.php?id=<?php echo $id;?>">Click here to send an introduction mail to this client</a></p>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>