<?php
    // realpath() раскрывает все символические ссылки, переходы типа /./, /../ и лишние символы / в пути path, возвращая канонизированный абсолютный путь к файлу
    if($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
        header('Location: ../index.php');
    }
    if(isset($_POST['login']) && !empty($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!empty($email) or !empty($password)){
            $email = $getFromU->checkInput($email);
            $password = $getFromU->checkInput($password);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = "Пожалуйста, введите корректный email!";
            } else {
                 if($getFromU->login($email, $password) === false){
                     $error = "email или пароль некорректны!";
                 }
            }
        } else {
            $error = "Пожалуйста, введите имя пользователя и пароль!";
        }
    }
?>
<div class="login-div">
    <form method="post">
        <ul>
            <li>
                <input type="text" name="email" placeholder="Email"/>
            </li>
            <li>
                <input type="password" name="password" placeholder="Пароль"/><input type="submit" name="login" value="Войти"/>
            </li>
            <li>
                <input type="checkbox" Value="Запомнить меня">Запомнить меня
            </li>
        </ul>
        <?php
            if(isset($error)){
                echo '<li class="error-li">
                      <div class="span-fp-error">'.$error.'</div>
                      </li>';
            }
        ?>
    </form>
</div>