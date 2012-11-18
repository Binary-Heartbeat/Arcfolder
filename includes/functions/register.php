<?php
	class register {
		public static function validate_username ($_, $localization, $username) {
			if(_db_rowExists($_, 'users', 'UserNiceName', $username)) { // check if $username already exists in the database
				echo '<br/>'.$localization['reg_err_username_taken'].PHP_EOL;
				return false;
			} else { // if $username isn't already in use, we run a few checks on it
				if(strlen($username) > 20) { // check if $username is longer than 20 characters
					echo '<br/>'.$localization['reg_err_username_long'].PHP_EOL;
					return false;
				} elseif(strlen($username) < 3) { // check if $username is shorter than 3 characters
					echo '<br/>'.$localization['reg_err_username_short'].PHP_EOL;
					return false;
				}
			}
			return true;
		}
		public static function validate_password ($_, $localization, $password, $password_confirm) {
			if($password === $password_confirm) { // check if $password and $password_confirm are EXACT matches
				if(strlen($password) < 8) { // Hmm, better make sure the password is an acceptable length
					echo '<br/>'.$localization['reg_err_password_short'].PHP_EOL;
					return false;
				} elseif(strlen($password) > 64) { // Lets make sure they don't exceed the length set for the database
					echo '<br/>'.$localization['reg_err_password_long'].PHP_EOL;
					return false;
				}
				$password_strength=0;

				$password_strength_letters='/[a-zA-Z]/'; // As silly as it seems, lets define the alphabet
				if(preg_match($password_strength_letters, $password)) { // check if $password contains letters
					$password_strength++;
					if($_['debug']===true) {echo PHP_EOL.'<br/>Letters present in password.';}
				}

				$password_strength_numbers='/[0123456789]/'; // Define numbers...
				if(preg_match($password_strength_numbers, $password)) { // check if $password contains numbers
					$password_strength++;
					if($_['debug']===true) {echo PHP_EOL.'<br/>Numbers present in password.';}
				}
				//!@#$%^&*()_-=+{}[]'.;:?";
				//"`~!@#$%^&*()-_=+[]{};:'\\|/,.<>/?"
				$password_strength_symbols="[\`\~\!\@\#\$\%\^\&\*\(\)\-\_\=\+\[\{\]\}\;\:\"\\\|\,\<\.\>\/\?]"; // And lastly symbols
				if(strpbrk($password, $password_strength_symbols)) { // check if $password contains symbols
					$password_strength++;
					if($_['debug']===true) {echo PHP_EOL.'<br/>Symbols present in password.';}
				}
				if($_['debug']===true) {echo PHP_EOL.'<br/> $password_strength = '.$password_strength;}
				if($password_strength < 2) { // Make sure that the password contains at least two types of characters
					echo '<br/>'.$localization['reg_err_password_insecure'].PHP_EOL;
					return false;
				}
			} else {
				echo '<br/>'.$localization['reg_err_password_mismatch'].PHP_EOL;
				return false;
			}
			return true;
		}
		public static function validate_email ($_, $localization, $email, $email_confirm) {
			if(_db_rowExists($_, 'users', 'UserEmail', $email)) { // check if $username already exists in the database
				echo '<br/>'.$localization['reg_err_email_taken'].PHP_EOL;
				return false;
			} else {
				if($email === $email_confirm) { // check if $email and $email_confirm are EXACT matches
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) // Hmm, better make sure the email address is in a valid form
					{
						echo '<br/>'.$localization['reg_err_email_invalid'].PHP_EOL;
						return false;
					}
				} else {
					echo '<br/>'.$localization['reg_err_email_mismatch'].PHP_EOL;
					return false;
				}
			}
			return true;
		}
	}
