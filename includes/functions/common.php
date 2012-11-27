<?php
	function _debug($_, $message) {
		if($_['debug']===true) {echo '<br/> Debug: '.$message.PHP_EOL;}
	}

	function _error($_, $level, $message) {
		if($level==1) {	$prefix=''; }
		elseif($level==2) { $prefix='Arcfolder, Fatal Error: '; }
	}
	function _log($_,$text,$type,$user) {
		$query = "INSERT INTO ".$_['table_prefix']."logs(LogType,LogUser,LogText,LogDateTime) VALUES(?,?,?,NOW());";
		$statement=db::connect($_)->prepare($query);
		$statement->execute(array($type,$user,$text));
		db::close($statement);
	}
/* Type key for _log()
1 - register
2 - login
3 - logout
4 - cookie/token renewed
5 - expired cookie/token destroyed
*/
