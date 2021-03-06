<?php

$body = <<< heredoc
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
    body {
        padding: 1rem;
        background-color: #0275bf;
    }
    * {
        color: white;
    }
    img {
        max-height: 200px;
    }
</style>
</head>
<body>
    <h1>Password Recovery</h1>
    <p>Recover your password by clicking on the following link: <a href="%s/forgotPassword.php?forgotPasswordCode=%s&email=%s" target="_blank">Password Recovery</a></p>
    <p>The link expires 30 minutes after the recovery request.</p>
    <footer>
        <h2>Team %s</h2>
        <img class="m-auto" src="%s">
        <p><a href="%s" target="_blank">%s</a></p>
    </footer>
</body>
</html>
heredoc;
