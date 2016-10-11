<?php

session_start();

if ( $_SESSION['loggedin'] == false ) {
	header("Location: login.php");
	exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login successful</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
	<div class="content" id="login_success">
      <h1>Login successful</h1>
	  <p style="text-align: center;"><a href="create-client.php">Create a client</a></p>
	  <p style="text-align: center;"><a href="dashboard.php">Edit clients</a></p>
	  <p style="text-align: center;"><a href="logout.php">Logout</a></p>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>