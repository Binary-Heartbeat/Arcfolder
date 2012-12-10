<?php
//	Hostname for your database server
$_['db_host'] = 'localhost';

//	Username to connect to the database server with
$_['db_user'] = 'root';

//	Password to connect to the database server with
$_['db_pass'] = 'november';

//	The name of the database for Arcfolder
$_['db_name'] = 'arcfolder';

//	The prefix to use
$_['table_prefix'] = 'af_';

// Location of the Arcfolder installation on the filesystem
$_['fs_root'] = '';

//	Turns debug mode within Arcfolder on/off. Can be true or false.
$_['debug'] = false;

require_once($_['fs_root'].'init.php'); // No touchy
