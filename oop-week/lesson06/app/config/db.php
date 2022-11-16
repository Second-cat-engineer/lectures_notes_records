<?php

use KebaCorp\VaultSecret\VaultSecret;

return [
    'class'    => yii\db\Connection::class,
    'dsn'      => 'mysql:host='
        . VaultSecret::getSecret('MYSQL_DB_HOST') . ';port='
        . VaultSecret::getSecret('MYSQL_DB_PORT') . ';dbname='
        . VaultSecret::getSecret('MYSQL_DATABASE'),
    'username' => VaultSecret::getSecret('MYSQL_USERNAME'),
    'password' => VaultSecret::getSecret('MYSQL_PASSWORD'),
    'charset'  => VaultSecret::getSecret('MYSQL_DATABASE_CHARSET'),

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
