<?php
require_once($_['fs_root'].'/includes/localizations/'.$_['localization'].'.php');
require_once($_['fs_root'].'includes/functions/auth.php');
require_once($_['fs_root'].'includes/functions/database.php');
require_once($_['fs_root'].'includes/functions/register.php');

$_['con'] = 'mysql:host='.$_['db_host'].';dbname='.$_['db_name'].';';
