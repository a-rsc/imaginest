<?php

function helper_password_hash($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

// php/app/accountDeleted.php
function update_accountDeleted($iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE users SET removedOn = now() WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array($iduser));
}

// php/app/accountProfile.php
function select_accountProfile($iduser, $username)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) AS existe FROM users WHERE iduser != ? AND username = ? LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($iduser, $username));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_accountProfile($username, $firstname, $lastname, $iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE users SET username = ?, firstname = ?, lastname = ? WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array($username, $firstname, $lastname, $iduser));
}

// php/app/accountSecurity.php
function select_accountSecurity($iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT password FROM users WHERE iduser = ? LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($iduser));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_accountSecurity($newPassword, $iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE users SET password = ? WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array(helper_password_hash($newPassword), $iduser));
}

// php/app/register.php
function select_register($username, $email)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) AS existe FROM users WHERE username = ? || email = ? LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($username, $email));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function insert_register($username, $email, $firstname, $lastname, $password, $activationCode)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'INSERT INTO users (username, email, firstname, lastname, password, activationCode) VALUES(?, ?, ?, ?, ?, ?)';

    $insert = $bbdd->prepare($sql);
    return $insert->execute(array($username, $email, $firstname, $lastname, password_hash($password, PASSWORD_DEFAULT), $activationCode));
}

// php/app/activation.php
function select_activation($email, $activationCode)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT iduser, email FROM users WHERE (email = ? && activationCode = ?) && active = 0 && removedOn is null LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($email, $activationCode));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_activation($iduser)
{
    global $bbdd;

    $sql = 'UPDATE users SET active = 1, activationCode = NULL, activationDate = now() WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array($iduser));
}

// php/app/changePassword.php
function select_changePassword($email, $forgotPasswordCode)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT iduser FROM users WHERE (email = ? && resetPasswordCode = ?) && resetPasswordExpiry > (now() - interval 30 minute) && resetPassword = 1 && removedOn is null LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($email, $forgotPasswordCode));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_changePassword($password, $iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE users SET password = ?, resetPassword = 0, resetPasswordCode = NULL, resetPasswordExpiry = now() WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array(helper_password_hash($password), $iduser));
}

// php/app/forgotPassword.php
function select_forgotPassword($forgotPassword)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT iduser, email FROM users WHERE (username = ? || email = ?) && removedOn is null LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($forgotPassword, $forgotPassword));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_forgotPassword($resetPasswordCode, $iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE users SET resetPasswordCode = ?, resetPassword = 1, resetPasswordExpiry = now() WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array($resetPasswordCode, $iduser));
}

// php/app/home.php
function select_home_images($iduser, $search = '')
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT i.*, u.username
    FROM images i
    LEFT JOIN images_has_users ih ON ih.images_idimages = i.idimages
    INNER JOIN users u ON u.iduser = i.users_iduser
    WHERE i.users_iduser != ? AND (ih.users_iduser IS NULL OR i.idimages NOT IN (SELECT images_idimages FROM images_has_users WHERE users_iduser = ?))
    AND i.description LIKE ?
    ORDER BY RAND() LIMIT 1;';

    $query = $bbdd->prepare($sql);
    $query->execute(array($iduser, $iduser, "%{$search}%"));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function select_home_likes($idimages)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) as likes
    FROM images_has_users
    WHERE images_idimages = ? AND vote = \'like\';';

    $query = $bbdd->prepare($sql);
    $query->execute(array($idimages));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function select_home_dislikes($idimages)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) as dislikes
    FROM images_has_users
    WHERE images_idimages = ? AND vote = \'dislike\';';

    $query = $bbdd->prepare($sql);
    $query->execute(array($idimages));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function select_hashtags_by_image($idimages)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT hashtags_hashtag FROM hashtags_has_images WHERE images_idimages = ?;';

    $query = $bbdd->prepare($sql);
    $query->execute(array($idimages));

    return $query->fetchAll();
}

// php/app/login.php
function select_login($login)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT iduser, username, email, password, firstname, lastname FROM users WHERE (username = ? || email = ?) && active = 1 && removedOn is null LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($login, $login));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_login($openSession, $iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE users SET openSession = ?, lastLogin = now() WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array((boolean) $openSession, $iduser));
}

function select_login_noActive($login)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT iduser, username, email, password, firstname, lastname FROM users WHERE (username = ? || email = ?) && active = 0 && removedOn is null LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($login, $login));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_login_noActive($openSession, $activationCode, $iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE users SET openSession = ?, activationCode = ? WHERE iduser = ?';
    $update = $bbdd->prepare($sql);

    return $update->execute(array((boolean) $openSession, $activationCode, $iduser));
}

function select_login_removed($login)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) AS existe FROM users WHERE (username = ? || email = ?) && removedOn is not null LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($login, $login));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

// php/app/upload.php
function insert_upload_image($iduser, $description, $name)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'INSERT INTO images (users_iduser, description, publicationDate, name) VALUES (?, ?, now(), ?)';
    $insert = $bbdd->prepare($sql);
    $insert->execute(array($iduser, $description, $name));

    return $bbdd->lastInsertId();
}

function select_upload_hashtag($hashtag)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) AS existe FROM hashtags WHERE hashtag = ? LIMIT 1';
    $query = $bbdd->prepare($sql);
    $query->execute(array($hashtag));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function insert_upload_hashtag($hashtag)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'INSERT INTO hashtags VALUES (?)';
    $insert = $bbdd->prepare($sql);
    return $insert->execute(array($hashtag));
}

function insert_upload_hashtags_has_image($lastInsertId, $hashtag)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'INSERT INTO hashtags_has_images VALUES (?, ?)';
    $insert = $bbdd->prepare($sql);
    return $insert->execute(array($lastInsertId, $hashtag));
}

// php/app/vote.php
function insert_vote_images_has_user($image, $iduser, $vote)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'INSERT INTO images_has_users VALUES (?, ?, ?);';
    $query = $bbdd->prepare($sql);
    return $query->execute(array($image, $iduser, $vote));
}

function select_vote_likes($image)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) as likes
    FROM images_has_users ih
    WHERE ih.images_idimages = ? AND ih.vote = \'like\';';

    $query = $bbdd->prepare($sql);
    $query->execute(array($image));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function select_vote_dislikes($image)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT count(*) as dislikes
    FROM images_has_users ih
    WHERE ih.images_idimages = ? AND ih.vote = \'dislike\';';

    $query = $bbdd->prepare($sql);
    $query->execute(array($image));

    return $query->fetch(\PDO::FETCH_ASSOC);
}

function update_vote($average, $image)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'UPDATE images SET average = ? WHERE idimages = ?;';

    $query = $bbdd->prepare($sql);
    return $query->execute(array($average, $image));
}

// php/app/myposts.php
function select_myposts($iduser)
{
    global $bbdd; // hacemos la variable $bbdd global para que la función tenga acceso.

    $sql = 'SELECT * FROM images WHERE users_iduser = ?';
    $query = $bbdd->prepare($sql);
    $query->execute(array($iduser));

    return $query->fetchAll(PDO::FETCH_ASSOC);
}
