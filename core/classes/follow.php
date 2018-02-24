<?php

class Follow extends User {
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function checkFollow($followID, $user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `follow` WHERE `sender` = :user_id AND `receiver` = :followID");
        $stmt->bindParam(":followID", $followID, PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function followBtn($profileID, $user_id){
        $data = $this->checkFollow($profileID, $user_id);
        if($this->loggedIn() === true){
            if($profileID != $user_id){
                if($data['receiver'] == $profileID){
                    // Following button
                    echo "<button class='f-btn following-btn follow-btn' data-follow='".$profileID."'>Following</button>";
                } else {
                    // Follow button
                    echo "<button class='f-btn follow-btn' data-follow='".$profileID."'><i class='fa fa-user-plus'></i>Follow</button>";
                }
            } else {
               // edit button
               echo "<button class='f-btn' onclick=location.href='profileEdit.php'>Edit Profile</button>";
            }
        } else {
            echo "<button class='f-btn' onclick=location.href='index.php'><i class='fa fa-user-plus'></i>Follow</button>";
        }
    }
}