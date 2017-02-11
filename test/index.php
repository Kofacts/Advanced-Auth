<?php
	require('../src/phpAbs.php');
	use Auth as Auth;

	$phpAuth= new Auth\phpAuth;


?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Auth Test</title>
</head>
<body>

	<form method="post" action="index.php">

		<input type="text" name="username"/><p></p>

		<input type="password" name="password"><p></p>
		
		<input type="checkbox" name="remember_me" id="rem_me">
		<label for="rem_me">Remember Me</label><br>

		<input type="submit" name="submit">
		
	</form>
	<?php $phpAuth->login('princes','rapheal'); ?>

</body>
</html>