<?php

try
{
    // Update sql
    $sql = 'UPDATE users SET removedOn = now() WHERE iduser = ?';
    $update = $db->prepare($sql);
    $update->execute(array($_SESSION['user']['iduser']));

    header('location: ../php/app/logout.php');
    exit();
}
catch (PDOException $e){
    echo 'Error amb la BDs: ' . $e->getMessage();
    return 1; // ERROR
}
