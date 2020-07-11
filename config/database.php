<?php

return [

    'driverDefault' => 'mysql',

    'mysql' => [
        'driver'    => 'mysql',
        'database'  => 'db_schedule_php',
        'username'  => 'guilherme',
        'password'  => '&!Lc7K$5q#',
        'host'      => '127.0.0.1',
        'port'      => '3306',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => 'tb_',
        'options'   => extension_loaded('pdo_mysql')
            ? array_filter([
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
				PDO::ATTR_CASE => PDO::CASE_NATURAL
            ]) 
            : [],
    ],

];