<?php

$bbdd_conexio = CONFIG['DRIVER'] . ':dbname=' . CONFIG['BBDD_NAME'] . ';host=' . CONFIG['HOST'];
$bbdd_user = CONFIG['BBDD_USER'];
$bbdd_password = CONFIG['BBDD_PASSWORD'];

try{
    //Creem una connexió persistent a BDs
    $db = new PDO($bbdd_conexio, $bbdd_user, $bbdd_password, array(PDO::ATTR_PERSISTENT => true));
}catch(PDOException $e){
    echo "Error amb la BDs: {$e->getMessage()}";
    exit();
}
