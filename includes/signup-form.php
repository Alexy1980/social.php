<?php
    if($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
        header('Location: ../index.php');
    }
    if(isset($_POST['signup'])){
        $screenName = $_POST['screenName'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $error = '';
        if(empty($screenName) or empty($password) or empty($email)){
            $error = 'Все поля должны быть заполнены!';
        } else {
            $email = $getFromU->checkInput($email);
            $screenName = $getFromU->checkInput($screenName);
            $password =$getFromU->checkInput($password);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = 'Некорректный email!';
            } else if(strlen($screenName) > 20) {
                $error = 'Имя должно содержать от 6 до 20 букв!';
            } else if(strlen($password) < 5){
                $error = 'Паспорт слишком короткий! Рекомендуется не менее 5 символов.';
            } else {
                if($getFromU->checkEmail($email) === true){
                    $error = 'Email уже используется!';
                } else {
                    $user_id = $getFromU->create('users', array('email' => $email, 'password' => md5($password), 'screenName' => $screenName, 'profileImage' => 'assets/images/defaultProfileImage.png', 'profileCover' => 'assets/images/defaultCoverImage.png'));
                    $_SESSION['user_id'] = $user_id;
                    header('Location: includes/signup.php?step=1');
                }
            }
        }
    }
?>
<form method="post">
    <div class="signup-div">
        <h3>Зарегистрироваться </h3>
        <ul>
            <li>
                <input type="text" name="screenName" placeholder="Имя"/>
            </li>
            <li>
                <input type="email" name="email" placeholder="Email"/>
            </li>
            <li>
                <input type="password" name="password" placeholder="пароль"/>
            </li>
            <li>
                <input type="submit" name="signup" Value="Зарегистрироваться">
            </li>
        </ul>
        <?php
            if(isset($error)){
                echo '<li class="error-li">
                      <div class="span-fp-error">'.$error.'</div>
                      </li>';
            }
        ?>
    </div>
</form>
