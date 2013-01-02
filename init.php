<?php

// $_['public_fs'] = $_['fs_root'].'public/';
// $_['public_web'] = $_['web_root'].'public/';

include $_['fs_root'].'includes/lib/dBug.php';

require_once($_['fs_root'].'includes/lib/common/init.php'); // Include Binary Heartbeat's 'common' PHP lib
$_ = core::config($_); // Fill config array ($_) from database

require_once($_['fs_root'].'includes/lib/auth/init.php');  // Include Binary Heartbeat's 'auth' PHP lib

// Include Arcfolder PHP components
require_once($_['fs_root'].'includes/classes/page.php');
require_once($_['fs_root'].'includes/localizations/'.$_['localization'].'.php');

// Include 3rd party software
