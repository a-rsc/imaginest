<?php

function helper_password_hash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
