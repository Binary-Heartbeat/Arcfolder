<?php
require_once($_['fs_root'].'/includes/localizations/'.$_['localization'].'.php');
$_['con'] = 'mysql:host='.$_['db_host'].';dbname='.$_['db_name'].';';