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
        // Insert
        insert_vote_images_has_user($data['image'], $_SESSION['user']['iduser'], $data['vote']);

        // like
        $data = array_merge($data, select_vote_likes($data['image']));

        // dislike
        $data = array_merge($data, select_vote_dislikes($data['image']));

        $average = (float) $data['likes']/($data['likes'] + $data['dislikes']);

        // Update
        update_vote($average, $data['image']);
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}