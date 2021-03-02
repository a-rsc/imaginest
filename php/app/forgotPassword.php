<?php

$data = array();

$data['forgotPassword'] = filter_input(INPUT_POST, 'forgotPasswordUsername');

// username
if (!filter_var($data['forgotPassword'], FILTER_VALIDATE_EMAIL))
{
    if (!(
        strlen($data['forgotPassword']) >= VALIDATION['username']['length']['min'] &&
        strlen($data['forgotPassword']) <= VALIDATION['username']['length']['max']))
    {
        $errors['forgotPassword'][] = VALIDATION['username']['length']['msg'];
    }
}
else if (empty($data['forgotPassword']))
{
    $errors['forgotPassword'][] = VALIDATION['email']['required']['msg'];
}

if (empty($errors))
{
    try
    {
        // Se debe verificar que el username/email corresponde efectivamente con un username/email registrado en la tabla users y con valor 1 al campo resetPassword.
        // Se puede dar el caso que el usuario aún no haya activado su cuenta, por eso se utiliza el campo resetPassword
        $sql = 'SELECT iduser, email FROM users WHERE (username = ? || email = ?) && removedOn is null LIMIT 1';
        $query = $db->prepare($sql);
        $query->execute(array($data['forgotPassword'], $data['forgotPassword']));

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if (!empty($user) && $user['iduser'] != 0)
        {
            // Durante el proceso de registro del usuario se genera un aleatorio que se utiliza en la activación de la cuenta.
            $data['resetPasswordCode'] = hash('sha256', random_int(1, 1000));

            // Update sql
            $sql = "UPDATE users SET resetPasswordCode = ?, resetPassword = 1, resetPasswordExpiry = now() WHERE iduser = ?";
            $update = $db->prepare($sql);
            $update->execute(array($data['resetPasswordCode'], $user['iduser']));

            // https://www.php.net/manual/es/function.ob-end-clean.php
            // Las cabeceras html se escriben con PHPMailer y se muestra un error que no se puede realizar el redireccionamiento.
            ob_start();
            require_once('../php/email/forgotPassword.php');
            ob_end_clean();

            header("location: ./index.php?forgotPasswordPending");
            exit();
        }

        $errors['forgotPassword'][] = VALIDATION['noValidation']['error']['msg'];
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}