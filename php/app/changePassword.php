<?php

$data = array();

$data['email'] = filter_input(INPUT_POST, 'email');
$data['forgotPasswordCode'] = filter_input(INPUT_POST, 'forgotPasswordCode');
$data['password'] = filter_input(INPUT_POST, 'password');
$data['confirmPassword'] = filter_input(INPUT_POST, 'confirmPassword');

// email
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
{
    if (!(
        strlen($data['email']) >= VALIDATION['email']['length']['min'] &&
        strlen($data['email']) <= VALIDATION['email']['length']['max']))
    {
        $errors['email'][] = VALIDATION['email']['length']['msg'];
    }
}
else if (empty($data['email']))
{
    $errors['email'][] = VALIDATION['email']['required']['msg'];
}

// password
if (!(
    strlen($data['password']) >= VALIDATION['password']['length']['min'] &&
    strlen($data['password']) <= VALIDATION['password']['length']['max']))
{
    $errors['password'][] = VALIDATION['password']['length']['msg'];
}
else if ($data['password'] != $data['confirmPassword'])
{
    $errors['password'][] = VALIDATION['password']['confirm']['msg'];
}
else if (empty($data['password']))
{
    $errors['password'][] = VALIDATION['password']['required']['msg'];
}

if (empty($errors))
{
    try
    {
        // Se debe verificar que el username/email corresponde efectivamente con un username/email registrado en la tabla users...
        $user = select_changePassword($data['email'], $data['forgotPasswordCode']);

        if (!empty($user) && $user['iduser'] != 0)
        {
            // Update
            update_changePassword($data['password'], $user['iduser']);

            // https://www.php.net/manual/es/function.ob-end-clean.php
            // Las cabeceras html se escriben con PHPMailer y se muestra un error que no se puede realizar el redireccionamiento.
            ob_start();
            require_once('../php/email/changePassword.php');
            ob_end_clean();

            header("location: " . CONFIG['URL'] . "/index.php?resetPasswordSuccess");
            exit();
        }

        $errors['noValidation'][] = VALIDATION['noValidation']['error']['msg'];
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}