<?php

include "database/connection.php";
//include "classes/user.php";
//include "classes/follow.php";
//include "classes/tweet.php";

spl_autoload_register(function ($class_name) {
    include 'classes/'.$class_name . '.php';
});

global $pdo;

session_start();

$getFromU = new User($pdo);
$getFromT = new Tweet($pdo);
$getFromF = new Follow($pdo);

define("BASE_URL", "http://twitter/");