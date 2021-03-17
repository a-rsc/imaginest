<?php

$havefun = array();

try
{
    // image
    $havefun = select_home_images($_SESSION['user']['iduser']);

    if (!empty($havefun))
    {
        // like
        $havefun = array_merge($havefun, select_home_likes($havefun['idimages']));

        // dislike
        $havefun = array_merge($havefun, select_home_dislikes($havefun['idimages']));

        // hashtags
        $havefun['hashtags'] = array_column(select_hashtags_by_image($havefun['idimages']), 'hashtags_hashtag');
    }
}
catch (PDOException $e)
{
    echo 'Error amb la BDs: ' . $e->getMessage();
    return 1; // ERROR
}
