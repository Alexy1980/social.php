<?php

$dsn = 'mysql:host=localhost; dbname=twitter';
$user = 'paul';
$pass = '';

try{
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e){
    echo 'Проблемы с подключением к базе данных! '.$e->getMessage();
}
