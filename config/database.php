<?php 

return [
	
	'default' => 'mysql',

	'mysql' => [

		'driver' => 'App\Database\MySql',

		'host' => 'localhost',

		'port' => '3306',

		'database' => 'dbname',

		'username' => 'root',

		'password' => 'password',

		'charset' => 'utf8',
            
        'collation' => 'utf8_unicode_ci',
	],

];
