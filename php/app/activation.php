<?php

$data = array();

$data['email'] = filter_input(INPUT_GET, 'email');
$data['activationCode'] = filter_input(INPUT_GET, 'activationCode');

try
{
    $sql = 'SELECT iduser, email FROM users WHERE (email = ? && activationCode = ?) && active = 0 && removedOn is null LIMIT 1';
    $query = $db->prepare($sql);
    $query->execute(array($data['email'], $data['activationCode']));

    if ($query)
    {
        foreach ($query as $user)
        {
            // Update sql
            $sql = "UPDATE users SET active = 1, activationCode = NULL, activationDate = now() WHERE iduser = ?";
            $update = $db->prepare($sql);
            $update->execute(array($user['iduser']));

            require_once('../php/app/toast/activationSuccess.php');
        }
    }
}
catch (PDOException $e)
{
    echo 'Error amb la BDs: ' . $e->getMessage();
    return 1; // ERROR
}
