<?php
    include '../init.php';
    if(isset($_POST['search']) && !empty($_POST['search'])){
        $search = $getFromU->checkInput($_POST['search']);
        $result = $getFromU->search($search);
        $base_url = BASE_URL;
        if(!empty($result)){
            echo '<div class="nav-right-down-wrap"><ul>';
            foreach($result as $user){
                echo <<<LABEL
                <li>
                        <div class="nav-right-down-inner">
                            <div class="nav-right-down-left">
                                <a href="{$base_url}{$user->username}"><img src="{$base_url}{$user->profileImage}"></a>
                            </div>
                            <div class="nav-right-down-right">
                                <div class="nav-right-down-right-headline">
                                    <a href="{$base_url}{$user->username}">$user->screenName</a><span>@$user->username</span>
                                </div>
                                <div class="nav-right-down-right-body">

                                </div>
                            </div>
                        </div>
                     </li>
LABEL;
            }
            echo '</ul></div>';
        }
    }