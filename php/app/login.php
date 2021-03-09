<?php

$data = array();

$data['login'] = filter_input(INPUT_POST, 'username');
$data['password'] = filter_input(INPUT_POST, 'password');
if (isset($_POST['openSession'])) $data['openSession'] = filter_input(INPUT_POST, 'openSession');

// username
if (!filter_var($data['login'], FILTER_VALIDATE_EMAIL))
{
    if (!(
        strlen($data['login']) >= VALIDATION['username']['length']['min'] &&
        strlen($data['login']) <= VALIDATION['username']['length']['max']))
    {
        $errors['username'][] = VALIDATION['username']['length']['msg'];
    }
}
else if (empty($data['login']))
{
    $errors['username'][] = VALIDATION['username']['required']['msg'];
}

// password
if (!(
    strlen($data['password']) >= VALIDATION['password']['length']['min'] &&
    strlen($data['password']) <= VALIDATION['password']['length']['max']))
{
    $errors['password'] = VALIDATION['password']['length']['msg'];
}
else if (empty($data['password']))
{
    $errors['password'][] = VALIDATION['password']['required']['msg'];
}

if (empty($errors))
{
    try
    {
        // Se debe verificar que el username/email corresponde efectivamente con un username/email registrado en la tabla users y con valor 1 al campo active.
        $sql = 'SELECT iduser, username, email, password, firstname, lastname FROM users WHERE (username = ? || email = ?) && active = 1 && removedOn is null LIMIT 1';
        $query = $db->prepare($sql);
        $query->execute(array($data['login'], $data['login']));

        if ($query)
        {
            foreach ($query as $user)
            {
                if (password_verify($data['password'], $user['password']))
                {
                    // Update sql
                    $sql = 'UPDATE users SET openSession = ?, lastLogin = now() WHERE iduser = ?';
                    $update = $db->prepare($sql);
                    $update->execute(array((boolean) $data['openSession'], $user['iduser']));

                    // El login implica la creación de una sesión de usuario y distintas cookies.
                    // session_start();
                    $_SESSION['user'] = $user;
                    setcookie("username", $user['username'], time()+3600*24*7);
                    setcookie("email", $user['email'], time()+3600*24*7);
                    setcookie("openSession", $data['openSession'], time()+3600*24*7);

                    header("location: ./home.php");
                    exit();
                }
            }
        }

        // Se debe verificar que el username/email corresponde efectivamente con un username/email registrado en la tabla users y con valor 1 al campo active.
        $sql = 'SELECT iduser, username, email, password, firstname, lastname FROM users WHERE (username = ? || email = ?) && removedOn is null LIMIT 1';
        $query = $db->prepare($sql);
        $query->execute(array($data['login'], $data['login']));

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if (!empty($user) && $user['iduser'] != 0)
        {
            if (password_verify($data['password'], $user['password']))
            {
                // Update sql
                // Si el usuario ha perdido el código de activación, cuando intenta logearse si no está activo se vuelve a enviar otro código
                $data['activationCode'] = hash('sha256', random_int(1, 1000));
                $sql = 'UPDATE users SET openSession = ?, activationCode = ? WHERE iduser = ?';
                $update = $db->prepare($sql);
                $update->execute(array((boolean) $data['openSession'], $data['activationCode'], $user['iduser']));

                // https://www.php.net/manual/es/function.ob-end-clean.php
                // Las cabeceras html se escriben con PHPMailer y se muestra un error que no se puede realizar el redireccionamiento.
                ob_start();
                require_once('../php/email/register.php');
                ob_end_clean();

                header("location: ./index.php?activationPending");
                exit();
            }
        }
        else
        {
            // Se debe verificar que el username/email corresponde efectivamente con un username/email registrado en la tabla users y con valor 1 al campo active.
            $sql = 'SELECT count(*) AS count FROM users WHERE (username = ? || email = ?) && removedOn is not null LIMIT 1';
            $query = $db->prepare($sql);
            $query->execute(array($data['login'], $data['login']));

            if ($query->rowCount() != 0)
            {
                $errors['accountDeleted'][] = VALIDATION['accountDeleted']['error']['msg'];
            }
        }

        $errors['noValidation'][] = VALIDATION['noValidation']['error']['msg'];
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}