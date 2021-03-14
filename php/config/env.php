<?php

define('CONFIG', array(
    'APP_NAME' => 'Imaginest',
    'APP_LOCALE' => 'en',
    'APP_IMAGE' => '/assets/img/imaginest.jpg',
    // bbdd
    'DRIVER' => 'mysql',
    'BBDD_NAME' => 'imaginest',
    'HOST' => 'localhost',
    'URL' => 'http://localhost/imaginest/public',
    'BBDD_USER' => 'root',
    'BBDD_PASSWORD' => '',
));

require_once(__DIR__ . '.\constants.php');
require_once(__DIR__ . '.\email.php');
require_once(dirname(__DIR__, 1) . '.\bbdd\connecta_db_persistent.php');
require_once(dirname(__DIR__, 1) . '.\app\helpers.php');
