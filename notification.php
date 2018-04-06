<?php
    include 'core/init.php';
    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);
    $notify = $getFromM->getNotificationCount($user_id);
    // $getFromU->create('users', array('username' => 'petya', 'email' => 'petya@mail.ru', 'password' => md5('170680')));
    // $getFromU->update('users', $user_id, array('username' => 'vasya'));
    if($getFromU->loggedIn() === false){
        header('Location: index.php');
    }

    // $getFromU->delete('comments', array('commentID' => '1'));

    if(isset($_POST['tweet'])){
        $status = $getFromU->checkinput($_POST['status']);
        $tweetImage = '';
        if(!empty($status) or !empty($_POST['file']['name'][0])){
            if(!empty($_FILES['file']['name'][0])){
                $tweetImage = $getFromU->uploadImage($_FILES['file']);
            }
            if(strlen($status) > 140){
                $error = "Текст Вашего сообщения слишком длинный!";
            }
            $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date('Y-m-d H:i:s')));

            preg_match_all("/#+([a-zA-Z0-9]+)/i", $status, $hashtag);
            if(!empty($hashtag)){
                $getFromT->addTrend($status);
            }
        } else {
            $error = "Выберите картинку для вставки";
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Tweety</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
</head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
    <!-- header wrapper -->
    <div class="header-wrapper">

        <div class="nav-container">
            <!-- Nav -->
            <div class="nav">
                <div class="nav-left">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                        <li><a href="<?php echo BASE_URL; ?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification<span id="notification"><?php if($notify->totalN > 0){echo '<span class="span-i">'.$notify->totalN.'</span>';} ?></span></a></li>
                        <li id="messagePopup"><i class="fa fa-envelope" aria-hidden="true"></i>Messages<span id="messages"><?php if($notify->totalM > 0){echo '<span class="span-i">'.$notify->totalM.'</span>';} ?></span></li>
                    </ul>
                </div><!-- nav left ends-->

                <div class="nav-right">
                    <ul>
                        <li>
                            <input type="text" placeholder="Search" class="search"/>
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <div class="search-result">
                            </div>
                        </li>

                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profileImage; ?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
                                        <li><a href="<?php echo BASE_URL.$user->username; ?>"><?php echo $user->username; ?></a></li>
                                        <li><a href="<?php echo BASE_URL; ?>settings/account">Settings</a></li>
                                        <li><a href="<?php echo BASE_URL; ?>includes/logout.php">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><label class="addTweetBtn">Tweet</label></li>
                    </ul>
                </div><!-- nav right ends-->

            </div><!-- nav ends -->

        </div><!-- nav container ends -->

    </div><!-- header wrapper end -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/search.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/hashtag.js"></script>
    <!---Inner wrapper-->
    <div class="inner-wrapper">
        <div class="in-wrapper">
            <div class="in-full-wrap">
                <div class="in-left">
                    <div class="in-left-wrap">
                        <div class="info-box">
                            <div class="info-inner">
                                <div class="info-in-head">
                                    <!-- PROFILE-COVER-IMAGE -->
                                    <img src="<?php echo BASE_URL.$user->profileCover;?>"/>
                                </div><!-- info in head end -->
                                <div class="info-in-body">
                                    <div class="in-b-box">
                                        <div class="in-b-img">
                                            <!-- PROFILE-IMAGE -->
                                            <img src="<?php echo BASE_URL.$user->profileImage;?>"/>
                                        </div>
                                    </div><!--  in b box end-->
                                    <div class="info-body-name">
                                        <div class="in-b-name">
                                            <div><a href="<?php echo BASE_URL.$user->username;?>"><?php echo $user->screenName;?></a></div>
                                            <span><small><a href="<?php echo BASE_URL.$user->username;?>">@<?php echo $user->screenName;?></a></small></span>
                                        </div><!-- in b name end-->
                                    </div><!-- info body name end-->
                                </div><!-- info in body end-->
                                <div class="info-in-footer">
                                    <div class="number-wrapper">
                                        <div class="num-box">
                                            <div class="num-head">
                                                TWEETS
                                            </div>
                                            <div class="num-body">
                                                <?php $getFromT->countTweets($user_id); ?>
                                            </div>
                                        </div>
                                        <div class="num-box">
                                            <div class="num-head">
                                                FOLLOWING
                                            </div>
                                            <div class="num-body">
                                                <span class="count-following"><?php echo $user->following; ?></span>
                                            </div>
                                        </div>
                                        <div class="num-box">
                                            <div class="num-head">
                                                FOLLOWERS
                                            </div>
                                            <div class="num-body">
                                                <span class="count-followers"><?php echo $user->followers; ?></span>
                                            </div>
                                        </div>
                                    </div><!-- mumber wrapper-->
                                </div><!-- info in footer -->
                            </div><!-- info inner end -->
                        </div><!-- info box end-->

                        <!--==TRENDS==-->
                        <?php $getFromT->trends(); ?>
                        <!--==TRENDS==-->

                    </div><!-- in left wrap-->
                </div><!-- in left end-->
                <div class="in-center">
                    <div class="in-center-wrap">

                        <!--NOTIFICATION WRAPPER FULL WRAPPER-->
                        <div class="notification-full-wrapper">

                            <div class="notification-full-head">
                                <div>
                                    <a href="#">All</a>
                                </div>
                                <div>
                                    <a href="#">Mention</a>
                                </div>
                                <div>
                                    <a href="#">settings</a>
                                </div>
                            </div>

                            <!-- Follow Notification -->
                            <!--NOTIFICATION WRAPPER-->
                            <div class="notification-wrapper">
                                <div class="notification-inner">
                                    <div class="notification-header">

                                        <div class="notification-img">
				<span class="follow-logo">
					<i class="fa fa-child" aria-hidden="true"></i>
				</span>
                                        </div>
                                        <div class="notification-name">
                                            <div>
                                                <img src="TWEET-IMAGE"/>
                                            </div>

                                        </div>
                                        <div class="notification-tweet">
                                            <a href="" class="notifi-name">SCREEN-NAME</a><span> Followed you your - <span>TIME</span>

                                        </div>

                                    </div>

                                </div>
                                <!--NOTIFICATION-INNER END-->
                            </div>
                            <!--NOTIFICATION WRAPPER END-->
                            <!-- Follow Notification -->


                            <!-- Like Notification -->
                            <!--NOTIFICATION WRAPPER-->
                            <div class="notification-wrapper">
                                <div class="notification-inner">
                                    <div class="notification-header">
                                        <div class="notification-img">
				<span class="heart-logo">
					<i class="fa fa-heart" aria-hidden="true"></i>
				</span>
                                        </div>
                                        <div class="notification-name">
                                            <div>
                                                <img src="PROFILE-IMAGE"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notification-tweet">
                                        <a href="" class="notifi-name">SCREEN-NAME</a><span> liked your TWEET - <span>TIME</span>
                                    </div>
                                    <div class="notification-footer">
                                        <div class="noti-footer-inner">
                                            <div class="noti-footer-inner-left">
                                                <div class="t-h-c-name">
                                                    <span><a href="PROFILE-LINK">SCREEN-NAME</a></span>
                                                    <span>@USERNAME</span>
                                                    <span>TWEET-TIME</span>
                                                </div>
                                                <div class="noti-footer-inner-right-text">
                                                    STATUS
                                                </div>
                                            </div>
                                            <div class="noti-footer-inner-right">
                                                <img src="TWEET-IMAGE"/>
                                            </div>

                                        </div><!--END NOTIFICATION-inner-->
                                    </div>
                                </div>
                            </div>
                            <!--NOTIFICATION WRAPPER END-->
                            <!-- Like Notification -->
                            <!-- Retweet Notification -->
                            <!--NOTIFICATION WRAPPER-->
                            <div class="notification-wrapper">
                                <div class="notification-inner">
                                    <div class="notification-header">

                                        <div class="notification-img">
                                        <span class="retweet-logo">
                                            <i class="fa fa-retweet" aria-hidden="true"></i>
                                        </span>
                                        </div>
                                        <div class="notification-tweet">
                                            <a href="" class="notifi-name">SCREEN-NAME</a><span> retweet your TWEET -                                                       <span>TIME</span>
                                        </div>
                                        <div class="notification-footer">
                                            <div class="noti-footer-inner">

                                                <div class="noti-footer-inner-left">
                                                    <div class="t-h-c-name">
                                                        <span><a href="PROFILE-LINK">SCREEN-NAME</a></span>
                                                        <span>@USERNAME</span>
                                                        <span>TWEET-TIME</span>
                                                    </div>
                                                    <div class="noti-footer-inner-right-text">
                                                        STATUS
                                                    </div>
                                                </div>

                                                <div class="noti-footer-inner-right">
                                                    <img src="TWEET-IMAGE"/>
                                                </div>

                                            </div><!--END NOTIFICATION-inner-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--NOTIFICATION WRAPPER END-->
                            <!-- Retweet Notification -->
                        </div>
                        <!--NOTIFICATION WRAPPER FULL WRAPPER END-->
                        <div class="loading-div">
                            <img id="loader" src="<?php echo BASE_URL; ?>assets/images/loading.svg" style="display: none;"/>
                        </div>
                        <div class="popupTweet"></div>
                        <!--Tweet END WRAPER-->
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/like.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/retweet.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popuptweets.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/delete.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/comment.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popupForm.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fetch.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/messages.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/postMessage.js"></script>
                        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/notification.js"></script>
                    </div><!-- in left wrap-->
                </div><!-- in center end -->

                <div class="in-right">
                    <div class="in-right-wrap">

                        <!--Who To Follow-->
                        <?php $getFromF->whoToFollow($user_id, $user_id); ?>
                        <!--Who To Follow-->

                    </div><!-- in left wrap-->
                    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/follow.js"></script>
                </div><!-- in right end -->

            </div><!--in full wrap end-->
        </div><!-- in wrappper ends-->
    </div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->
</body>

</html>
