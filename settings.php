<?php
echo '<br/>'.PHP_EOL;
echo '<a href="'.$_['web_root'].'manager/register.php">register</a>'.PHP_EOL;
echo '<a href="'.$_['web_root'].'manager/login.php">login</a>'.PHP_EOL;
echo '<a href="'.$_['web_root'].'manager/logout.php">logout</a>'.PHP_EOL;
echo '<a href="'.$_['web_root'].'sandbox.php">sandbox</a>'.PHP_EOL;
echo '<br/>'.PHP_EOL;

$_['public_fs'] = $_['fs_root'].'public/';
$_['public_web'] = $_['web_root'].'public/';

require_once($_['fs_root'].'includes/localizations/'.$_['localization'].'.php');
require_once($_['fs_root'].'includes/functions/database.php');
require_once($_['fs_root'].'includes/functions/common.php');

$authpath='C:/Users/jekotia/DropBox/Binary Heartbeat/Projects/Auth/Source/';
require_once($authpath.'bridge.php');
