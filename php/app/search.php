<?php

$data = array();

$data['search'] = filter_input(INPUT_POST, 'search');

if(!empty($data['search']))
{
    // image
    $havefun = select_home_images($_SESSION['user']['iduser'], $data['search']);

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