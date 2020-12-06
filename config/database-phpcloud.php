<?php

return [
    'development' => [
        'type'              => 'mysql',
        'host'              => 'localhost',
        'port'              => '3306',
        'user'              => 'root',
        'pass'              => 'password',
        'database'          => 'test',
        'singleTransaction' => false,
    ],
    'production' => [
        'type'     => 'postgresql',
        'host'     => SERVER,
        'port'     => PORT,
        'user'     => USER,
        'pass'     => PASS,
        'database' => DB,
    ],
];
