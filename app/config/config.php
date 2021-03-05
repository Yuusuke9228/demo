<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'erphalcon',
        'password'    => 'erphalcon',
        'dbname'      => 'demo',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'controllersMrpDir' => __DIR__ . '/../../app/controllers/mrp/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'migrationsDir'  => __DIR__ . '/../../app/migrations/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'formsDir'       => __DIR__ . '/../../app/forms',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        'vendorDir'      => __DIR__ . '/../../app/vendor/',
        'baseUri'        => '/demo/',
        'staticUri'      => '/demo/',
    )
));
