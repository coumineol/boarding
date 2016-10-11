<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
	<div class="content" id="login">
      <h1>Login</h1>
      <form method="post" action="login-control.php" style="text-align: center;">
        <p style="margin: 0;"><input type="text" name="username" value="" placeholder="Username"></p>
        <p style="margin: 0;"><input type="password" name="password" value="" placeholder="Password"></p>
		<p style="margin: 0;"><input type="password" name="pin" value="" placeholder="Pin"></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>