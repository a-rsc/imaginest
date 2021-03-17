<?php

$data = array();

$data['email'] = filter_input(INPUT_GET, 'email');
$data['activationCode'] = filter_input(INPUT_GET, 'activationCode');

try
{
    // Se debe verificar que existe las condiciones de activación del usuario en la BDs.
    $user = select_activation($data['email'], $data['activationCode']);

    if (!empty($user) && $user['iduser'] != 0)
    {
        // Update
        update_activation($user['iduser']);

        require_once('../php/app/alert/activationSuccess.php');
    }
    else
    {
        header("location: " . CONFIG['URL'] . "/index.php");
        exit();
    }
}
catch (PDOException $e)
{
    echo 'Error amb la BDs: ' . $e->getMessage();
    return 1; // ERROR
}
