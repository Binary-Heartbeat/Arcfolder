<?php

$_['public_fs'] = $_['fs_root'].'public/';
$_['public_web'] = $_['web_root'].'public/';

require_once($_['fs_root'].'includes/localizations/'.$_['localization'].'.php');

require_once($_['fs_root'].'common/init.php');
require_once($_['fs_root'].'auth/init.php');
