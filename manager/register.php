<?php

require_once('../config.php');
require_once($_['fs_root'].'settings.php');
require_once($_['fs_root'].'includes/functions/database.php');
require_once($_['fs_root'].'includes/functions/auth.php');

if (isset($_POST['trigger']) and $_POST['trigger'] == true) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];

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
	if(_db_rowExists($_, 'users', 'UserNiceName', $username)) {
		echo '<br/>'.$localization['reg_err_username_taken'].PHP_EOL;
		$reg_fail = true;
	} elseif(strlen($username) > 16) {
		//header('Location: register);
		echo '<br/>'.$localization['reg_err_username_long'].PHP_EOL;
		$reg_fail = true;
	}
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
}

echo '<br/>'.PHP_EOL.
'<form name="register" action="register.php" method="post">'.PHP_EOL.
'	'.$localization['reg_form_username'].': <input type="text" name="username" maxlength="16" /><br/>'.PHP_EOL.
'	'.$localization['reg_form_password'].': <input type="password" name="password" /><br/>'.PHP_EOL.
'	'.$localization['reg_form_password_again'].': <input type="password" name="password_confirm" /><br/>'.PHP_EOL.
'	<input type="submit" value="'.$localization['reg_form_register'].'" />'.PHP_EOL.
'	<input name="trigger" type="hidden" value="true">'.PHP_EOL.
'</form>';