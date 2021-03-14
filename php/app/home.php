<?php

$havefun = array();

try
{
    // image
    $sql = 'SELECT i.*, u.username
    FROM images i
    LEFT JOIN images_has_users ih ON ih.images_idimages = i.idimages
    INNER JOIN users u ON u.iduser = i.users_iduser
    WHERE i.users_iduser != ? AND (ih.users_iduser IS NULL OR i.idimages NOT IN (SELECT images_idimages FROM images_has_users WHERE users_iduser = ?))
    ORDER BY RAND() LIMIT 1;';

    $query = $db->prepare($sql);
    $query->execute(array($_SESSION['user']['iduser'], $_SESSION['user']['iduser']));

    $havefun = $query->fetch(\PDO::FETCH_ASSOC);

    if (!empty($havefun))
    {
        // like
        $sql = 'SELECT count(*) as likes
        FROM images_has_users
        WHERE images_idimages = ? AND vote = \'like\';';

        $query = $db->prepare($sql);
        $query->execute(array($havefun['idimages']));

        $havefun = array_merge($havefun, $query->fetch(\PDO::FETCH_ASSOC));

        // dislike
        $sql = 'SELECT count(*) as dislikes
        FROM images_has_users
        WHERE images_idimages = ? AND vote = \'dislike\';';

        $query = $db->prepare($sql);
        $query->execute(array($havefun['idimages']));

        $havefun = array_merge($havefun, $query->fetch(\PDO::FETCH_ASSOC));

        // hashtags
        $sql = 'SELECT hashtags_hashtag FROM hashtags_has_images WHERE images_idimages = ?;';

        $query = $db->prepare($sql);
        $query->execute(array($havefun['idimages']));

        $havefun['hashtags'] = array_column($query->fetchAll(), 'hashtags_hashtag');
    }
}
catch (PDOException $e)
{
    echo 'Error amb la BDs: ' . $e->getMessage();
    return 1; // ERROR
}
