<?php
require_once($_['fs_root'].'/includes/localizations/'.$_['localization'].'.php');
require_once($_['fs_root'].'includes/functions/auth.php');
require_once($_['fs_root'].'includes/functions/database.php');
$_['con'] = 'mysql:host='.$_['db_host'].';dbname='.$_['db_name'].';';


// Salting time! http://stackoverflow.com/questions/5032341/where-is-the-best-place-to-store-the-password-salt-for-the-website
if($_['salt']=getenv('SALT')) {
	if($_['debug']===true){ echo '<br/>Debug: $salt obtained from .htaccess'.PHP_EOL; }
} else {
	if(file_put_contents($_['fs_root'].'.htaccess', 'SetEnv SALT '.salt())) {
		if($_['debug']===true) { echo '<br/>Debug: $salt written to .htaccess'.PHP_EOL; }
	} else {
		echo "CRITICAL ERROR, Environmental Variable 'salt' missing from .htaccess, unable to write file.";
		die();
	}
}
