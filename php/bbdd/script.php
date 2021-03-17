<?php

require_once(dirname(__DIR__, 1) . '.\config\env.php');

require_once(__DIR__ . '.\bbdd.php');

try{

    $sql = 'INSERT INTO users (username, email, firstname, lastname, password, active) VALUES ("alvaro", "a_rsc@hotmail.com", "Álvaro", "Rodríguez", ?, 1), ("david", "david@hotmail.com", "David", "Rodríguez", ?, 1), ("oscar", "oscar@hotmail.com", "Óscar", "Rodríguez", ?, 1), ("benito", "benito@hotmail.com", "Benito", "Rodríguez", ?, 1), ("mariona", "mariona@hotmail.com", "Mariona", "Rodríguez", ?, 1), ("inmanol", "inmanol@hotmail.com", "Inmanol", "", ?, 1), ("carlos", "carlos@hotmail.com", "Carlos", "Gilete", ?, 1), ("raul", "raul@hotmail.com", "Raul", "Bellido", ?, 1)';

    $insert = $bbdd->prepare($sql);
    $insert->execute(array(helper_password_hash('sahara'), helper_password_hash('sahara'), helper_password_hash('sahara'), helper_password_hash('sahara'), helper_password_hash('sahara'), helper_password_hash('sahara'), helper_password_hash('sahara'), helper_password_hash('sahara')));

    if(!$insert){
        print_r( $bbdd->errorinfo());
    }

}catch(PDOException $e){
    echo 'Error amb la BDs: ' . $e->getMessage();
    exit();
}
