<?php

try
{
    // Update
    if (update_accountDeleted($_SESSION['user']['iduser']))
    {
        header('location: ../php/app/logout.php');
    }
    else
    {
        header("location: {$_SERVER['PHP_SELF']}?error");
    }

    exit();
}
catch (PDOException $e){
    echo 'Error amb la BDs: ' . $e->getMessage();
    return 1; // ERROR
}
