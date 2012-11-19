<?php

require_once('../config.php');

if (isset($_POST['trigger']) and $_POST['trigger'] == true) { // $trigger is set to true by submitting the login form
	// dump login form variables from post
	$usernicename = strtolower($_POST['username']);
	$password = $_POST['password'];

	$con = _db_connect($_);
	$query = "SELECT * FROM ".$_['table_prefix']."users WHERE UserNiceName=?;";
	$statement = $con->prepare($query);
	$statement->execute(array($usernicename));
	$statement = $con->query($query);
	if($row = $statement->fetch()) {

	} else {

	}
	$statement->closeCursor();

// $userID = from-db: UserID

	$con=_db_connect($_); // merge with prepare() line?
	$query="SELECT `UserPassword` FROM ".$_['table_prefix']."users WHERE UserID=?";
	$statement=$con->prepare($query);
	$statement->execute(array($userID));


	if (password::check($localization, $password, $hash)
	) {
		$con=_db_connect($_); // merge with prepare() line?
		$query="UPDATE ".$_['table_prefix']."users SET UserToken=?, UserIP=? WHERE UserID=?";
		$statement=$con->prepare($query);
		$statement->execute(array($newToken,$newIP,$userID));
		die();
	}
}
	echo '<br/>'.PHP_EOL.
	'<form name="login" action="login.php" method="post">'.PHP_EOL.
	'	'.$localization['login_form_username'].': <input type="text" name="username" maxlength="20" /><br/>'.PHP_EOL.
	'	'.$localization['login_form_password'].': <input type="password" name="password" /><br/>'.PHP_EOL.
	'	<input type="submit" value="'.$localization['login_form_submit'].'" />'.PHP_EOL.
	'	<input name="trigger" type="hidden" value="true">'.PHP_EOL.
	'</form>';
//}
