<?php

// $data = array();

// $data['search'] = filter_input(INPUT_POST, 'search');

$search = filter_input(INPUT_POST, 'search');

if($search<>'')
{
    $part = explode(" ", $search);
    $num = count($part);

    if($num == 1)
    {
        $cadbusca="SELECT  description FROM images WHERE description LIKE '%$search%'";

    }else if($num > 1)
    {
        $cadbusca="SELECT  description
      AGAINST (  '$search' ) AS busqueda FROM images WHERE
      MATCH ( description ) AGAINST (  '$search' ) ORDER  BY busqueda DESC";
    }
    $result=mysql($cadbusca);
    While($row=mysql_fetch_object($result))
    {
        $descripcion=$row->description;
        echo $descripcion."<br>";
    }
}