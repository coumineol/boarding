<?php

session_start();

/*
if ( $_SESSION['loggedin'] == false ) {
	header("Location: login.php");
	exit();
}
*/

require('database.php');

$tblname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

if ( isset( $_SESSION['username'] ) ) {
	$username = $_SESSION['username']; // username of the logged-in user
}

$sql_query = "SELECT * FROM clients";
$result = $conn->query( $sql_query );

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Client dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="content" id="client_dashboard">
	
		<h1>Client list</h1>
	
		<table>
			<thead>
			  <th>Id</th>
			  <th>Website</th>
			  <th>E-mail</th>
			  <th>Status</th>
			  <th></th>
			</thead>
			<tbody>
			<?php
			
			    while( $row = $result->fetch_array( MYSQLI_ASSOC ) ){
					echo '<tr>';
					echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['website'].'</td>';
					echo '<td>'.$row['email'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '<td><a href="application-data.php?id='.$row['id'].'">Details</a></td>';
					echo '</tr>';
			    }
				
				$result->free();
				$conn->close();

			?>
		   </tbody>
		</table>
	
	</div>
	<p style="text-align: center;"><a href="login-success.php">Go back to main page</a></p>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>