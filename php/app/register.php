<?php

$data = array();

$data['username']           = filter_input(INPUT_POST, 'username');
$data['firstname']          = filter_input(INPUT_POST, 'firstname');
$data['lastname']           = filter_input(INPUT_POST, 'lastname');
$data['email']              = filter_input(INPUT_POST, 'email');
$data['password']           = filter_input(INPUT_POST, 'password');
$data['confirmPassword']    = filter_input(INPUT_POST, 'confirmPassword');

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

// email
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
{
    $errors['email'][] = VALIDATION['email']['error']['msg'];
}
else if (!(
    strlen($data['email']) >= VALIDATION['email']['length']['min'] &&
    strlen($data['email']) <= VALIDATION['email']['length']['max']))
{
    $errors['email'][] = VALIDATION['email']['length']['msg'];
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
        // Se debe verificar que el username/email no existen en la BDs, si existieran se debería informar al usuario.
        $sql = 'SELECT iduser, email FROM users WHERE username = ? || email = ? LIMIT 1';
        $query = $db->prepare($sql);
        $query->execute(array($data['username'], $data['email']));

        if ($query->rowCount() == 0)
        {
            // Insert sql
            // Durante el proceso de registro del usuario se genera un aleatorio que se utiliza en la activación de la cuenta.
            $data['activationCode'] = hash('sha256', random_int(1, 1000));
            $sql = "INSERT INTO users (username, email, firstname, lastname, password, activationCode) VALUES(?, ?, ?, ?, ?, ?)";

            $insert = $db->prepare($sql);
            $insert->execute(array($data['username'], $data['email'], $data['firstname'], $data['lastname'], password_hash($data['password'], PASSWORD_DEFAULT), $data['activationCode']));

            // https://www.php.net/manual/es/function.ob-end-clean.php
            // Las cabeceras html se escriben con PHPMailer y se muestra un error que no se puede realizar el redireccionamiento.
            ob_start();
            require_once('../php/email/register.php');
            ob_end_clean();

            header("location: ./index.php?activationPending");
            exit();
        }

        $errors['noRegister'][] = VALIDATION['noRegister']['unique']['msg'];
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}