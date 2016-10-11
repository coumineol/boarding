<?php

$servername = "localhost";
$username = "root";
$password = "ogremage";
$dbname = "management";
$tblname = "users";

include("PHPAuth-alt/languages/en_GB.php");
require("PHPAuth-alt/config.php");
require("PHPAuth-alt/auth.php");

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$config = new Config($dbh);
$auth = new Auth($dbh, $config, $lang);

$login = $auth->login($_POST['username'], $_POST['password'], $remember = 1);

if($login['error']) {
    // Something went wrong
    exit;
} else {
    // Logged in successfully, set cookie, display success message
	setcookie($config->cookie_name, $login['hash'], $login['expire'], $config->cookie_path, $config->cookie_domain, $config->cookie_secure, $config->cookie_http);
    // echo '<div class="success">' . $login['message'] . '</div>';
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
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>