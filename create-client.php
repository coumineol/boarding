<?php
session_start();

if ( $_SESSION['loggedin'] == false ) {
	header("Location: login.php");
	exit();
}

$status = "";

$website = "";
$email = "";
$comments = "";

require('database.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	exit;
}

if(isset( $_POST['create_client_submit'] )) {
	$website = mysqli_real_escape_string($conn, $_REQUEST['website']);
	// $email = mysql_real_escape_string($_POST['email']);
	$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
	// $comments = mysql_real_escape_string($_POST['comments']);
	$comments = mysqli_real_escape_string($conn, $_REQUEST['comments']);
 
	$sql_query = "INSERT INTO clients(website,email,comments) VALUES('$website','$email','$comments')";
	$result = mysqli_query($conn, $sql_query);
	
	if (!$result) {
		$status = "There was an error.";
		// die();
	} else {
		$status = "Client created successfully.";
	}
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Create client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="content" id="create_client">
		<h2>Add new client</h2>
		<form method="POST" >
			<ul>
				<li><label>Website</label><input name="website" required></li>
				<li><label>E-mail</label><input name="email" required></li>
				<li><label>Comments</label><input name="comments" size="100"></li>
			</ul>
			<input id="create_client_submit" name="create_client_submit" type="submit" value="Create client"/>
		</form>
		<p style="padding-left: 25px;"><?php echo $status?></p>
		<p style="padding-left: 25px;"><a href="login-success.php">Go back to main page</a></p>
	</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>