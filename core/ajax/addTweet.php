<?php
    include '../init.php';
    $getFromU->preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));
    if(isset($_POST) && !empty($_POST)){
        $status = $getFromU->checkInput($_POST['status']);
        $user_id = $_SESSION['user_id'];
        $tweetImage = '';

        if(!empty($status) or !empty($_POST['file']['name'])){
            if(!empty($_FILES['file']['name'][0])){
                $tweetImage = $getFromU->uploadImage($_FILES['file']);
            }
            if(strlen($status) > 140){
                $error = "Текст Вашего сообщения слишком длинный!";
            }
            $tweet_id = $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date('Y-m-d H:i:s')));

            preg_match_all("/#+([a-zA-Z0-9]+)/i", $status, $hashtag);
            if(!empty($hashtag)){
                $getFromT->addTrend($status);
            }
            $getFromT->addMention($status, $user_id, $tweet_id);
            $result['success'] = "Все ОК!!";
            echo json_encode($result);
        } else {
            $error = "Выберите картинку для вставки";
            $result['error'] = $error;
            echo json_encode($result);
        }
        /*if(isset($error)){
            $result['error'] = $error;
            echo json_encode($result);
        }*/
    }
?>