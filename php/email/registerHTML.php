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
    <h1>Activate your account</h1>
    <p>Activate your account by clicking on the following link: <a href="%s/index.php?activationCode=%s&email=%s" target="_blank">Activate your account</a></p>
    <footer>
        <h2>Team %s</h2>
        <img class="m-auto" src="%s">
        <p><a href="%s" target="_blank">%s</a></p>
    </footer>
</body>
</html>
heredoc;
