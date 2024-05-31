<?php

use MysqlCredentials\MysqlCredentials;
$credentials = MysqlCredentials::init();
return [
    'propel' => [
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => 'mysql',
                    'dsn' => MysqlCredentials::getDSN(),
                    'user' => $credentials->getUser(),
                    'password' => $credentials->getPassword(),
                    'settings' => [
                        'charset' => $credentials->getCharset()
                    ]
                ]
            ]
        ]
    ]
];