<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => getenv('DB_HOST'),
                    'port' => '3306',
                    'user' => getenv('DB_USER'),
                    'password' => getenv('DB_PASSWORD'),
                    'dbname' => getenv('DB_NAME'),
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ]
    ]
];
