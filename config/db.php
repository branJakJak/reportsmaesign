<?php

$dbConfiguration = [
	    'class' => 'yii\db\Connection',
	    'dsn' => 'mysql:host=localhost;dbname=site8_esign',
	    'username' => 'site8_esign',
	    'password' => 'hitman052529',
	    'charset' => 'utf8',
	];
if (defined('YII_DEBUG') && defined('YII_ENV') == 'dev') {
	$dbConfiguration =  [
	    'class' => 'yii\db\Connection',
	    'dsn' => 'mysql:host=localhost;dbname=reportsma_esign',
	    'username' => 'root',
	    'password' => '',
	    'charset' => 'utf8',
	];
}
return $dbConfiguration;