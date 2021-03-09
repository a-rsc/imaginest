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
    <h1>Changed Password</h1>
    <p>You have changed the password.</p>
    <footer>
        <h2>Team %s</h2>
        <img class="m-auto" src="%s">
        <p><a href="%s" target="_blank">%s</a></p>
    </footer>
</body>
</html>
heredoc;
