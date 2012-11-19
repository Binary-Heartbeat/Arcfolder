<?php

require_once('../config.php');

if (isset($_POST['trigger']) and $_POST['trigger'] == true) { // $trigger is set to true by submitting the registration form
	// dump registration form variables from post
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$email = $_POST['email'];
	$email_confirm = $_POST['email_confirm'];

	$register_valid_username=false;	//
	$register_valid_password=false;	// we assume this are false unless the coming if's set them otherwise
	$register_valid_email=false;	//

	if(preg_match('/[^a-zA-Z0123456789-_]/', $username)) {
		echo '<br/>'.$localization['reg_err_username_invalid'].PHP_EOL;
	} else {
		if(_db_rowExists($_, 'users', 'UserNiceName', $username)) { // check if $username already exists in the database
			echo '<br/>'.$localization['reg_err_username_taken'].PHP_EOL;
		} else { // if $username isn't already in use, we run a few checks on it
			if(strlen($username) > 20) { // check if $username is longer than 20 characters
				echo '<br/>'.$localization['reg_err_username_long'].PHP_EOL;
			} elseif(strlen($username) < 3) { // check if $username is shorter than 3 characters
				echo '<br/>'.$localization['reg_err_username_short'].PHP_EOL;
			} else {
				$register_valid_username=true;
			}
		}
	}

	if(validate_password::match($_, $localization, $password, $password_confirm)) {
		if(validate_password::length($_, $localization, $password)) {
			if(validate_password::strength($_, $localization, $password)) {
				$register_valid_password=true;
			}
		}
	}

	if(validate_email::match($_, $localization, $email, $email_confirm)) {
		if(validate_email::syntax($_, $localization, $email)) {
			if(validate_email::available($_, $localization, $email)) {
				$register_valid_email=true;
			}
		}
	}

	if ($register_valid_username===true and $register_valid_password===true and $register_valid_email===true)
	{
		$hash = password::hash($_, $password);
		$nicename = strtolower($username);
		$ip=$_SERVER['REMOTE_ADDR'];

		$con=_db_connect($_); // merge with prepare() line?
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
	'	<input type="submit" value="'.$localization['reg_form_submit'].'" />'.PHP_EOL.
	'	<input name="trigger" type="hidden" value="true">'.PHP_EOL.
	'</form>';
//}
