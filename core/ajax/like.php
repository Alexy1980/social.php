<?php
    include '../init.php';
    $getFromU->preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));
    if(isset($_POST['like']) && !empty($_POST['like'])){
        // id пользователя
        $user_id = $_SESSION['user_id'];
        $tweet_id = $_POST['like'];
        // id пользователя, добавившего лайк
        $get_id = $_POST['user_id'];
        $getFromT->addLike($user_id, $tweet_id, $get_id);
    }

    if(isset($_POST['unlike']) && !empty($_POST['unlike'])){
        // id пользователя
        $user_id = $_SESSION['user_id'];
        $tweet_id = $_POST['unlike'];
        // id пользователя, добавившего лайк
        $get_id = $_POST['user_id'];
        $getFromT->unlike($user_id, $tweet_id, $get_id);
    }