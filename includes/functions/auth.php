<?php
	class validate_password {
		public static function match ($_, $localization, $password, $password_confirm) {
			if($password === $password_confirm) { // check if $password and $password_confirm are EXACT matches
				if($_['debug']===true) {echo '<br/> Debug: $password and $password_confirm are exact matches.'.PHP_EOL;}
				return true;
			} else {
				echo '<br/>'.$localization['validate_password_match_error'].PHP_EOL;
				return false;
			}
		}
		public static function length ($_, $localization, $password) {
			if(strlen($password) < 8) { // Hmm, better make sure the password is an acceptable length
				echo '<br/>'.$localization['validate_password_length_short_error'].PHP_EOL;
				return false;
			} elseif (strlen($password) > 64) { // Lets make sure they don't exceed the length set for the database
				echo '<br/>'.$localization['validate_password_length_long_error'].PHP_EOL;
				return false;
			} else {
				if($_['debug']===true) {echo '<br/> Debug:  Password is a valid length.'.PHP_EOL;}
				return true;
			}
		}
		public static function strength ($_, $localization, $password) {
			$password_strength=0;

			$password_strength_letters='/[a-zA-Z]/'; // As silly as it seems, lets define the alphabet
			if(preg_match($password_strength_letters, $password)) { // check if $password contains letters
				$password_strength++;
				if($_['debug']===true) {echo '<br/> Debug: Letters present in password.'.PHP_EOL;}
			} else {
				if($_['debug']===true) {echo '<br/> Debug: Letters not present in password.'.PHP_EOL;}
			}
			$password_strength_numbers='/[0123456789]/'; // Define numbers...
			if(preg_match($password_strength_numbers, $password)) { // check if $password contains numbers
				if($_['debug']===true) {echo '<br/> Debug: Numbers present in password.'.PHP_EOL;}
				$password_strength++;
			} else {
				if($_['debug']===true) {echo '<br/> Debug: Numbers not present in password.'.PHP_EOL;}
			}
			$password_strength_symbols="/[`~!@#$%^&*()-_=+\[{\]};:\\|,<.>\/?]/"; // And lastly symbols
			if(preg_match($password_strength_symbols, $password)) { // check if $password contains symbols
				if($_['debug']===true) {echo '<br/> Debug: Symbols present in password.'.PHP_EOL;}
				$password_strength++;
			} else {
				if($_['debug']===true) {echo '<br/> Debug: Symbols not present in password.'.PHP_EOL;}
			}

			if($_['debug']===true) {echo '<br/> Debug:  $password_strength = '.$password_strength.PHP_EOL;}

			if($password_strength < 2) { // Make sure that the password contains at least two types of characters
				echo '<br/>'.$localization['validate_password_strength_error'].PHP_EOL;
				return false;
			} else {
				if($_['debug']===true) {echo '<br/> Debug:  Password contains characters from two, or all, of the following: letters, numbers, symbols.'.PHP_EOL;}
				return true;
			}
		}
	}

	class validate_email {
		public static function match ($_, $localization, $email, $email_confirm) {
			if($email === $email_confirm) { // check if $email and $email_confirm are EXACT matches
				if($_['debug']===true) {echo '<br/> Debug:  $email and $email_confirm are exact matches.'.PHP_EOL;}
				return true;
			} else {
				echo '<br/>'.$localization['validate_email_match_error'].PHP_EOL;
				return false;
			}
		}
		public static function syntax ($_, $localization, $email) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) { // Hmm, better make sure the email address is in a valid form
				if($_['debug']===true) {echo '<br/> Debug:  Email address is valid syntax.'.PHP_EOL;}
				return true;
			} else {
				echo '<br/>'.$localization['validate_email_syntax_error'].PHP_EOL;
				return false;
			}
		}
		public static function available ($_, $localization, $email) {
			if(_db_rowExists($_, 'users', 'UserEmail', $email)) { // check if $username already exists in the database
				echo '<br/>'.$localization['validate_email_available_error'].PHP_EOL;
				return false;
			} else {
				if($_['debug']===true) {echo '<br/> Debug:  Email address is available.'.PHP_EOL;}
				return true;
			}
		}
	}

	class validate_login {

	}
	class password { // http://net.tutsplus.com/tutorials/php/understanding-hash-functions-and-keeping-passwords-safe/
		private static $algo = '$2a'; // blowfish
		private static $cost = '$10'; // cost parameter
		public static function hash($_, $password) { // this will be used to generate a hash
			return crypt($password,
						self::$algo .
						self::$cost .
						'$' . $_['salt']);
						//'$' . self::unique_salt());
		}
		public static function check($hash, $password) { // this will be used to compare a password against a hash
			$full_salt = substr($hash, 0, 29);
			$new_hash = crypt($password, $full_salt);
			return ($hash == $new_hash);
		}
	}

	class login {
		public static function check_password() {
			if (password::check($user['pass_hash'], $_POST['password'])) {
				// grant access
			} else {
				// deny access
			}
		}
	}
	function salt() {
		return substr(sha1(mt_rand()),0,22);
	}
