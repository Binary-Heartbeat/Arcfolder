<?php

require_once('../config.php');
require_once($_['fs_root'].'settings.php');
require_once($_['fs_root'].'includes/functions/database.php');
require_once($_['fs_root'].'includes/functions/auth.php');

// BEGIN Registration Validation
if (isset($_POST['trigger']) and $_POST['trigger'] == true) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$email = $_POST['email'];
	$email_confirm = $_POST['email_confirm'];

	// BEGIN Username Validation
	if(_db_rowExists($_, 'users', 'UserNiceName', $username)) {
		echo '<br/>'.$localization['reg_err_username_taken'].PHP_EOL;
		$reg_fail = true;
	} elseif(strlen($username) > 25) {
		//header('Location: register);
		echo '<br/>'.$localization['reg_err_username_long'].PHP_EOL;
		$reg_fail = true;
	}
	// END Username Validation
	// BEGIN Password Validation
	if($password === $password_confirm) {
		$reg_fail = false;
		$password=$password;
		unset($password_confirm);
		if(strlen($password) < 8)
		{
			echo '<br/>'.$localization['reg_err_password_short'].PHP_EOL;
			$reg_fail = true;
		}
//		if; check if password is alphanumeric
		{
			//echo '<br/>'.$localization['reg_err_password_nonalphanumeric'].PHP_EOL;
			//$reg_fail = true;
		}
	} else {
		//header('Location: register);
		echo '<br/>'.$localization['reg_err_password_mismatch'].PHP_EOL;
		$reg_fail = true;
	}
	// END Password validation
	// BEGIN Email Validation
	// END Email Validation
// END Registration Validation
// BEGIN Registration
	if (isset($reg_fail) and $reg_fail == false) {
		function createSalt()
		{
			$string = md5(uniqid(rand(), true));
			return substr($string, 0, 3);
		}
		$salt = createSalt();
		$hash = hash('sha256', $password);
		$hash = hash('sha256', $salt . $hash);
		$nicename = strtolower($username);
		$ip=$_SERVER['REMOTE_ADDR'];

		$con=_db_connect($_);
		$query="INSERT INTO ".$_['table_prefix']."users(UserName,UserNiceName,UserPassword,UserSalt,UserIP) VALUES(?,?,?,?,?);";
		$statement=$con->prepare($query);
		$statement->execute(array($username,$nicename,$hash,$salt,$ip));
		
		echo '<br/>'.$localization['reg_success_1'].'<a href="login.php">'.$localization['reg_success_2'].'</a>'.$localization['reg_success_3'].PHP_EOL;
		die();
	}
// END Registration
} else {
	echo '<br/>'.PHP_EOL.
	'<form name="register" action="register.php" method="post">'.PHP_EOL.
	'	'.$localization['reg_form_username'].': <input type="text" name="username" maxlength="25" /><br/>'.PHP_EOL.
	'	'.$localization['reg_form_password'].': <input type="password" name="password" /><br/>'.PHP_EOL.
	'	'.$localization['reg_form_password_again'].': <input type="password" name="password_confirm" /><br/>'.PHP_EOL.
	
	'	'.$localization['reg_form_email'].': <input type="text" name="email" /><br/>'.PHP_EOL.
	'	'.$localization['reg_form_email_again'].': <input type="text" name="email_confirm" /><br/>'.PHP_EOL.
	
	'	<input type="submit" value="'.$localization['reg_form_register'].'" />'.PHP_EOL.
	'	<input name="trigger" type="hidden" value="true">'.PHP_EOL.
	'</form>';
}