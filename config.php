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

// Localization file to use
$_['localization'] = 'en-uk';

//	Turns debug mode within Arcfolder on/off. Can be true or false.
$_['debug'] = true;

// Name of the site used in page titles
$_['site_name'] = 'Arcfolder Official Addons Repository';

// Location of the Arcfolder installation relative to the domain
$_['web_root'] = '/public/arcfolder/';

// Location of the Arcfolder installation on the filesystem
$_['fs_root'] = 'C:/xampp/htdocs/public/arcfolder/';

$_['cookie_name'] = 'af'; // change these to invalidate all previously set cookies

$_['cookie_expiry'] = '900'; // how many seconds cookies are valid


require_once($_['fs_root'].'settings.php'); // No touchy
