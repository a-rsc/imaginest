<?php

$data = array();

$data['password'] = filter_input(INPUT_POST, 'password');
$data['newPassword'] = filter_input(INPUT_POST, 'newPassword');
$data['confirmPassword'] = filter_input(INPUT_POST, 'confirmPassword');

// password
if (!(
    strlen($data['password']) >= VALIDATION['password']['length']['min'] &&
    strlen($data['password']) <= VALIDATION['password']['length']['max']))
{
    $errors['password'][] = VALIDATION['password']['length']['msg'];
}
else if (empty($data['password']))
{
    $errors['password'][] = VALIDATION['password']['required']['msg'];
}

// newPassword
if (!(
    strlen($data['newPassword']) >= VALIDATION['password']['length']['min'] &&
    strlen($data['newPassword']) <= VALIDATION['password']['length']['max']
))
{
    $errors['newPassword'][] = VALIDATION['password']['length']['msg'];
}
else if ($data['newPassword'] != $data['confirmPassword'])
{
    $errors['newPassword'][] = VALIDATION['password']['confirm']['msg'];
}

if (empty($errors))
{
    try
    {
        // Select sql
        $sql = 'SELECT password FROM users WHERE iduser = ? LIMIT 1';
        $query = $db->prepare($sql);
        $query->execute(array($_SESSION['user']['iduser']));

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if (empty($errors) && (!empty($user)) && password_verify($data['password'], $user['password']))
        {
            // Update sql
            $sql = 'UPDATE users SET password = ? WHERE iduser = ?';
            $update = $db->prepare($sql);
            $update->execute(array(helper_password_hash($data['newPassword']), $_SESSION['user']['iduser']));

            // https://www.php.net/manual/es/function.ob-end-clean.php
            // Las cabeceras html se escriben con PHPMailer y se muestra un error que no se puede realizar el redireccionamiento.
            ob_start();
            require_once('../php/email/changePassword.php');
            ob_end_clean();

        }
        else if (!password_verify($data['password'], $user['password']))
        {
            $errors['password'][] = VALIDATION['password']['error']['msg'];
        }
    }
    catch (PDOException $e){
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}
