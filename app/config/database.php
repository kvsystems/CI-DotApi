<?php

$config['database']['default_group'] = 'master';
$config['database']['connections']['master'] = [
    'name'     => 'tasks',
    'driver'   => 'mysql',
    'hostname' => '',
    'username' => '',
    'password' => '',
    'database' => '',
    'port'     => '3306',
    'encrypt'  => false,
];
$config['database']['connections']['slave'] = [
    'name'     => 'cabinet',
    'driver'   => 'mysql',
    'hostname' => '',
    'username' => '',
    'password' => '',
    'database' => '',
    'port'     => '3306',
    'encrypt'  => false,
];