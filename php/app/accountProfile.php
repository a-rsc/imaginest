<?php

$data = array();

$data['username'] = filter_input(INPUT_POST, 'username');
$data['firstname'] = filter_input(INPUT_POST, 'firstname');
$data['lastname'] = filter_input(INPUT_POST, 'lastname');

// username
if (!(
    strlen($data['username']) >= VALIDATION['username']['length']['min'] &&
    strlen($data['username']) <= VALIDATION['username']['length']['max']))
{

    $errors['username'][] = VALIDATION['password']['length']['msg'];
}
else if (empty($data['username']))
{
    $errors['username'][] = VALIDATION['username']['required']['msg'];
}

// firstname
if (!empty($data['firstname']))
{
    if (!(
        strlen($data['firstname']) >= VALIDATION['firstname']['length']['min'] &&
        strlen($data['firstname']) <= VALIDATION['firstname']['length']['max']))
    {
        $errors['firstname'][] = VALIDATION['firstname']['length']['msg'];
    }
}

// lastname
if (!empty($data['lastname']))
{
    if (!(
        strlen($data['lastname']) >= VALIDATION['lastname']['length']['min'] &&
        strlen($data['lastname']) <= VALIDATION['lastname']['length']['max']))
    {
        $errors['lastname'][] = VALIDATION['lastname']['length']['msg'];
    }
}

if (empty($errors))
{
    try
    {
        // Se debe verificar que el username no existe en la BDs.
        $result = select_accountProfile($_SESSION['user']['iduser'], $data['username']);

        if ($result['existe'] == 0)
        {
            // Update
            update_accountProfile($data['username'], $data['firstname'], $data['lastname'], $_SESSION['user']['iduser']);

            $_SESSION['user']['username'] = $data['username'];
            $_SESSION['user']['firstname'] = $data['firstname'];
            $_SESSION['user']['lastname'] = $data['lastname'];

            // https://www.php.net/manual/es/function.ob-end-clean.php
            // Las cabeceras html se escriben con PHPMailer y se muestra un error que no se puede realizar el redireccionamiento.
            ob_start();
            require_once('../php/email/changeProfile.php');
            ob_end_clean();
        }
        else
        {
            $errors['noProfile'][] = VALIDATION['noProfile']['error']['msg'];
        }
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}
