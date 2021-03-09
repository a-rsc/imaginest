<?php

$data = array();

$data['username'] = filter_input(INPUT_POST, 'username');
$data['firstname'] = filter_input(INPUT_POST, 'firstname');
$data['lastname'] = filter_input(INPUT_POST, 'lastname');
$data['email'] = filter_input(INPUT_POST, 'email');

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

if (empty($errors))
{
    try
    {
        // Update sql
        $sql = 'UPDATE users SET username = ?, firstname = ?, lastname = ?, email = ? WHERE iduser = ?';
        $update = $db->prepare($sql);
        $update->execute(array($data['username'], $data['firstname'], $data['lastname'], $data['email'], $_SESSION['user']['iduser']));

        $_SESSION['user']['username'] = $data['username'];
        $_SESSION['user']['firstname'] = $data['firstname'];
        $_SESSION['user']['firstname'] = $data['firstname'];
        $_SESSION['user']['email'] = $data['email'];
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}
