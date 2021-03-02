<?php

$body = <<< heredoc
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Password Recovery</h1>
    <p>Recover your password by clicking on the following link: <a href="%s/forgotPassword.php?forgotPasswordCode=%s&email=%s" target="_blank">here</a></p>
    <p>The link expires 30 minutes after the recovery request.</p>
    <footer>
        <h2>Team Imaginest</h2>
        <img src="%s/assets/img/imaginest.jpg" style="height: 100px;" />
        <p><a href="%s" target="_blank">%s</a></p>
    </footer>
</body>
</html>
heredoc;
