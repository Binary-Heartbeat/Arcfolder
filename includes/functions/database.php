<?php
	class db {
		public static function connect($_) {
			$_['con'] = 'mysql:host='.$_['db_host'].';dbname='.$_['db_name'].';';
			try {
				$con = new PDO($_['con'],$_['db_user'],$_['db_pass']); // mysql
			} catch(PDOException $e) {
				die ('Oops'); // Exit, displaying an error message
			}
			return $con;
		}
		public static function close($statement) {
			return $statement->closeCursor();
		}
		public static function getRow($_, $table, $column, $value) {
			$con = self::connect($_);
			$query = "SELECT * FROM ".$_['table_prefix'].$table." WHERE `".$column."` = '".$value."';";
			//$statement = $con->prepare($query);
			//$statement->execute();
			$statement = $con->query($query);
			$row = $statement->fetch();
			//$row = db::close($statement);
			return $row;
		}
		public static function rowExists($_, $table, $column, $value) {
			$con = self::connect($_);
			$query = "SELECT COUNT(*) FROM ".$_['table_prefix'].$table." WHERE `".$column."` = '".$value."';";
			$statement = $con->prepare($query);
			$statement->execute();
			$count = $statement->fetchColumn(); // investigate switching to rowCount instead of fetchColumn
			self::close($statement);
			if ($count !== '1') {
				return FALSE;
			} else {
				return TRUE;
			}
		}
		function updateRow($_, $table, $column, $value, $findColumn, $findValue) {
			$con = self::connect($_);
			$query = "UPDATE ".$_['table_prefix'].$table." SET ".$column."='".$value."' WHERE `".$findColumn."` = '".$findValue."';";

			$statement = $con->prepare($query);
			$statement->execute();
			self::close($statement);
		}
	}
