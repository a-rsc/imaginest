<?php

$body = <<< heredoc
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Activate your account</h1>
    <p>Activate your account by clicking on the following link: <a href="%s/index.php?activationCode=%s&email=%s" target="_blank">here</a></p>
    <footer>
        <h2>Team Imaginest</h2>
        <img src="%s/assets/img/imaginest.jpg" style="height: 100px;" />
        <p><a href="%s" target="_blank">%s</a></p>
    </footer>
</body>
</html>
heredoc;
