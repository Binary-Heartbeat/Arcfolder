<?php

function _db_connect($_) {
	try {
		$con = new PDO($_['con'],$_['db_user'],$_['db_pass']); // mysql
	} catch(PDOException $e) {
		die ('Oops'); // Exit, displaying an error message
	}
	return $con;
}

function _db_getRow($_, $table, $column, $value) {
	$con = _db_connect($_);
	$query = "SELECT * FROM ".$_['table_prefix'].$table." WHERE `".$column."` = '".$value."';";
	//$statement = $con->prepare($query);
	//$statement->execute();
	$statement = $con->query($query);
	$row = $statement->fetch();
	//$row = $statement->closeCursor();
	return $row;
}

function _db_rowExists($_, $table, $column, $value) {
	$con = _db_connect($_);
	$query = "SELECT COUNT(*) FROM ".$_['table_prefix'].$table." WHERE `".$column."` = '".$value."';";
	$statement = $con->prepare($query);
	$statement->execute();
	$count = $statement->fetchColumn(); // investigate switching to rowCount instead of fetchColumn
	echo $count;
	if ($count !== '1') {
		$count = $statement->closeCursor();
		return FALSE;
	} else {
		$count = $statement->closeCursor();
		return TRUE;
	}
}