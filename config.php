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

//	Database Charset to use in creating database tables.
$_['db_charset'] = 'utf8';

//	The Database Collate type. Don't change this if in doubt.
$_['db_collate'] = '';

// Localization file to use
$_['localization'] = 'en-uk';

//	Turns debug mode within Arcfolder on/off. Currently not working.
//	Can be true or false
$_['debug'] = false;

// Name of the site used in page titles
$_['site_name'] = 'Arcfolder Official Addons Repository';

// Location of the Arcfolder installation relative to the domain
$_['web_root'] = '/public/arcfolder/';

// Location of the Arcfolder installation on the filesystem
$_['fs_root'] = 'C:/xampp/htdocs/public/arcfolder/';

$_['cookie_username_title'] = 'herpaderpa1';
$_['cookie_token_title'] = 'herpaderpa2';


require_once($_['fs_root'].'settings.php'); // No touchy