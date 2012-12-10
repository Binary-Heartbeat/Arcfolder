<?php

// $_['public_fs'] = $_['fs_root'].'public/';
// $_['public_web'] = $_['web_root'].'public/';

require_once($_['fs_root'].'common/init.php'); // Include Binary Heartbeat's 'common' PHP components
$_ = core::config($_); // Fill config array ($_) from database

require_once($_['fs_root'].'auth/init.php');  // Include Binary Heartbeat's 'auth' PHP components

// Include Arcfolder PHP components
require_once($_['fs_root'].'includes/classes/form.php');
require_once($_['fs_root'].'includes/localizations/'.$_['localization'].'.php');


// Include 3rd party software
require_once($_['fs_root'].'includes/dBug.php');
