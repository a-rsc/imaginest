<?php

define('VALIDATION', array(
    'noValidation' => array(
        'error' => array(
            'msg' => "The fields are wrong!",
        ),
    ),
    'noRegister' => array(
        'unique' => array(
            'msg' => "Username and/or email have already been registered!",
        ),
    ),
    'noProfile' => array(
        'error' => array(
            'msg' => "Username and/or email have already been registered!",
        ),
    ),
    'accountDeleted' => array(
        'error' => array(
            'msg' => "The account has been deleted!",
        ),
    ),
    'username' => array(
        'error' => array(
            'msg' => "Username is incorrect!",
        ),
        'required' => array(
            'msg' => "Username is a required field!",
        ),
        'length' => array(
            'min' => 5,
            'max' => 60,
            'msg' => "Username is not the correct length!",
        ),
    ),
    'email' => array(
        'error' => array(
            'msg' => "Email is wrong!",
        ),
        'required' => array(
            'msg' => "Email is required field!",
        ),
        'length' => array(
            'min' => 5,
            'max' => 60,
            'msg' => "Email is not the correct length!",
        ),
    ),
    'firstname' => array(
        'error' => array(
            'msg' => "First name is incorrect!",
        ),
        'required' => array(
            'msg' => "First name is a required field!",
        ),
        'length' => array(
            'min' => 2,
            'max' => 60,
            'msg' => "First name is not the correct length!",
        ),
    ),
    'lastname' => array(
        'error' => array(
            'msg' => "Last name is incorrect!",
        ),
        'required' => array(
            'msg' => "Last name is required field!",
        ),
        'length' => array(
            'min' => 2,
            'max' => 60,
            'msg' => "Last name is not the correct length!",
        ),
    ),
    'password' => array(
        'error' => array(
            'msg' => "Password is incorrect!",
        ),
        'required' => array(
            'msg' => "Password is required field!",
        ),
        'confirm' => array(
            'msg' => "Passwords do not match!",
        ),
        'length' => array(
            'min' => 6,
            'max' => 60,
            'msg' => "Password is not the correct length!",
        ),
    ),
    'termsAndConditions' => array(
        'required' => array(
            'msg' => "Accept the Terms & Conditions is required!",
        ),
    ),
    'image' => array(
        'errorType' =>array(
            'msg' => "Image type is incorrect!",
        ),
        'errorImage' =>array(
            'msg' => "An error has occurred!",
        ),
        'errorSize' =>array(
            'msg' => "Image size is too large!",
        ),

        'errorMoreImages' =>array(
            'msg' => "Only one image can be uploaded!",
        ),
    ),
    'description' => array(
        'length' => array(
            'min' => 3, // No se aplica
            'max' => 300,
            'msg' => "Description is not the correct length!",
        ),
    ),
));
