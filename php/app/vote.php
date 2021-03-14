<?php

$data = array();

$data['image'] = (int )filter_input(INPUT_POST, 'image');
$data['vote'] = filter_input(INPUT_POST, 'vote');

// idimages
if (!is_int($data['image']) || ($data['vote'] !== 'like' && $data['vote'] !== 'dislike'))
{
    $errors['noValidation'][] = VALIDATION['username']['required']['msg'];
}

if (empty($errors))
{
    try
    {
        $sql = 'INSERT INTO images_has_users VALUES (?, ?, ?);';
        $query = $db->prepare($sql);
        $query->execute(array($data['image'], $_SESSION['user']['iduser'], $data['vote']));

        // like
        $sql = 'SELECT count(*) as likes
        FROM images_has_users ih
        WHERE ih.images_idimages = ? AND ih.vote = \'like\';';

        $query = $db->prepare($sql);
        $query->execute(array($data['image']));

        $data = array_merge($data, $query->fetch(\PDO::FETCH_ASSOC));

        // dislike
        $sql = 'SELECT count(*) as dislikes
        FROM images_has_users ih
        WHERE ih.images_idimages = ? AND ih.vote = \'dislike\';';

        $query = $db->prepare($sql);
        $query->execute(array($data['image']));

        $data = array_merge($data, $query->fetch(\PDO::FETCH_ASSOC));

        $average = (float) $data['likes']/($data['likes'] + $data['dislikes']);

        // average
        $sql = 'UPDATE images SET average = ? WHERE idimages = ?;';

        $query = $db->prepare($sql);
        $query->execute(array($average, $data['image']));
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}