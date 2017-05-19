<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=192.168.7.110;dbname=ev_monitoring',
    'dsn' => 'mysql:host=localhost;dbname=ev_monitoring',
    'username' => 'ev_monitoring',
    'password' => 'ev_monitoring',
    'charset' => 'utf8',
    'enableSchemaCache' => false,
    'schemaCacheDuration' => 30,
    'schemaCache' => 'cache',
];
