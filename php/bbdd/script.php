<?php

require_once('../config/env.php');
require_once('./connecta_db_persistent.php');
require_once('../app/helpers.php');

require_once('./bbdd.php');

try{

    // $sql = "INSERT INTO users (username, email, firstname, lastname, password) VALUES('alvaro', 'a_rsc@hotmail.com', 'Álvaro', 'Rodríguez', ?)";

    // $insert = $db->prepare($sql);
    // $insert->execute(array(helper_password_hash('sahara')));

    // if(!$insert){
    //     print_r( $db->errorinfo());
    // }

}catch(PDOException $e){
    echo 'Error amb la BDs: ' . $e->getMessage();
    exit();
}
