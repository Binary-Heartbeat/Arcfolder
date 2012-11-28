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

// Name of the site used in page titles
$_['site_name'] = 'Arcfolder Official Addons Repository';

// Location of the Arcfolder installation relative to the domain
$_['web_root'] = '/public/arcfolder/';

// Location of the Arcfolder installation on the filesystem
$_['fs_root'] = 'C:/Users/jekotia/DropBox/Binary Heartbeat/Projects/Arcfolder/Source/';

// Location of Arcfolder's 'public' folder on the filesystem, relative to $_['fs_root']. Do not include leading slash. Include trailing slash.
$_['public_fs'] = 'public/';
// Location of Arcfolder's 'public' folder on the domain, relative to $_['web_root']. Do not include leading slash. Include trailing slash.
$_['public_web'] = 'public/';

$_['cookie_name'] = 'bh'; // change this to invalidate all previously set cookies
$_['cookie_expiry'] = '900'; // how many seconds cookies are valid

$_['admin_email'] = 'contact@binaryheartbeat.net';

//	Turns debug mode within Arcfolder on/off. Can be true or false.
$_['debug'] = true;


require_once($_['fs_root'].'settings.php'); // No touchy
