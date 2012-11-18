<?php

require_once('../config.php');

if (isset($_POST['trigger']) and $_POST['trigger'] == true) { // $trigger is set to true by submitting the registration form
	// dump registration form variables from post
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$email = $_POST['email'];
	$email_confirm = $_POST['email_confirm'];

	if (register::validate_username($_, $localization, $username) and
		register::validate_password($_, $localization, $password, $password_confirm) and
		register::validate_email($_, $localization, $email, $email_confirm))
	{
		$hash = PassHash::hash($password);
		$nicename = strtolower($username);
		$ip=$_SERVER['REMOTE_ADDR'];

		$con=_db_connect($_); // merge with prepare() line
		$query="INSERT INTO ".$_['table_prefix']."users(UserName,UserNiceName,UserPassword,UserIP,UserEmail) VALUES(?,?,?,?,?);";
		$statement=$con->prepare($query);
		$statement->execute(array($username,$nicename,$hash,$ip,$email));

		echo '<br/>'.$localization['reg_success_1'].'<a href="login.php">'.$localization['reg_success_2'].'</a>'.$localization['reg_success_3'].PHP_EOL;
		die();
	}
}
	echo '<br/>'.PHP_EOL.
	'<form name="register" action="register.php" method="post">'.PHP_EOL.
	'	'.$localization['reg_form_username'].': <input type="text" name="username" maxlength="20" /><br/>'.PHP_EOL.
	'	'.$localization['reg_form_password'].': <input type="password" name="password" /><br/>'.PHP_EOL.
	'	'.$localization['reg_form_password_again'].': <input type="password" name="password_confirm" /><br/>'.PHP_EOL.
	'	'.$localization['reg_form_email'].': <input type="text" name="email" /><br/>'.PHP_EOL.
	'	'.$localization['reg_form_email_again'].': <input type="text" name="email_confirm" /><br/>'.PHP_EOL.
	'	<input type="submit" value="'.$localization['reg_form_register'].'" />'.PHP_EOL.
	'	<input name="trigger" type="hidden" value="true">'.PHP_EOL.
	'</form>';
//}
