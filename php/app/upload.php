<?php

$data = array();

$data['image'] = $_FILES['image'];

$data['name'] = $_FILES['image']['name'];
$data['size'] = $_FILES['image']['size'];
$data['error'] = $_FILES['image']['error'];
$data['type'] = $_FILES['image']['type'];
$data['type'] = $_FILES['image']['type'];
$data['description'] = filter_input(INPUT_POST, 'description');

$type = explode('.', $data['name']);
$extension = strtolower(end($type));
$extensionAllowed = array('jpg', 'jpeg', 'png');

if(in_array($extension, $extensionAllowed))
{
    if($data['error'] === 0)
    {
        // 5Mb
        if($data['size'] < 5*1024*1024)
        {
            $data['name'] .= random_int(1, 1000000);
        }
        else
        {
            $errors['image'][] = VALIDATION['image']['errorSize']['msg'];
        }
    }
    else
    {
        $errors['image'][] = VALIDATION['image']['errorImage']['msg'];
    }
}
else
{
    $errors['image'][] = VALIDATION['image']['errorType']['msg'];
}

// description
if(!empty($_POST['description']))
{
    if (!(strlen($data['description']) <= VALIDATION['description']['length']['max']))
    {
        $errors['description'][] = VALIDATION['description']['length']['msg'];
    }
}

if (empty($errors))
{
    try
    {
        $sql = 'INSERT INTO images (users_iduser, description, publicationDate, name) VALUES (?, ?, now(), ?)';
        $insert = $db->prepare($sql);
        $insert->execute(array($_SESSION['user']['iduser'], $data['description'], $data['name']));

        $lastInsertId = $db->lastInsertId();

        if(move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/{$data['name']}"))
        {
            preg_match_all('/(?<!\w)#\w+/', $data['description'], $hashtags);

            // reference
            foreach ($hashtags[0] as &$hashtag) {

                $hashtag = substr($hashtag, 1);

                $sql = 'SELECT count(*) AS count FROM hashtags WHERE hashtag = ? LIMIT 1';
                $query = $db->prepare($sql);
                $query->execute(array($hashtag));

                if ($query->rowCount() != 0)
                {
                    $sql = 'INSERT INTO hashtags VALUES (?)';
                    $insert = $db->prepare($sql);
                    $insert->execute(array($hashtag));
                }

                $sql = 'INSERT INTO hashtags_has_images VALUES (?, ?)';
                $insert = $db->prepare($sql);
                $insert->execute(array($lastInsertId, $hashtag));
            }
        }
    }
    catch (PDOException $e)
    {
        echo 'Error amb la BDs: ' . $e->getMessage();
        return 1; // ERROR
    }
}
