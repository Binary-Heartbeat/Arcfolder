<?php
	class PassHash { // http://net.tutsplus.com/tutorials/php/understanding-hash-functions-and-keeping-passwords-safe/
		private static $algo = '$2a'; // blowfish
		private static $cost = '$10'; // cost parameter
		public static function unique_salt() { // mainly for internal use
			return substr(sha1(mt_rand()),0,22);
		}
		public static function hash($password) { // this will be used to generate a hash
			return crypt($password,
						self::$algo .
						self::$cost .
						'$' . self::unique_salt());
		}
		public static function check_password($hash, $password) { // this will be used to compare a password against a hash
			$full_salt = substr($hash, 0, 29);
			$new_hash = crypt($password, $full_salt);
			return ($hash == $new_hash);
		}
	}

	class login {
		public static function check_password() {
			if (PassHash::check_password($user['pass_hash'], $_POST['password'])) {
				// grant access
			} else {
				// deny access
			}
		}
	}
