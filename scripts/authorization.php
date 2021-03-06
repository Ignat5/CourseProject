<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <style>
        body {
            background-color: #333;
        }
        div.register a {
            text-decoration: none;
            opacity: 0.7;
        }
        .error {
            color: red;
            font-size: 15px;
        }
        .ok {
            color: green;
            font-size: 15px;
        }
        div.all {
            text-align: center;
            /*background-color: lightpink;*/
            position: relative;
            margin-top: 30px;
            border: 2px solid white;
            padding: 20px;
        }
        input{
            border-radius: 8px;
            /*visibility: visible;*/
            text-align: left;
            background-color: white;
            font-size: 15px;
            padding: 5px;
        }
        input:hover {
            /*font-size: 31px;*/
            font-size: 16px;
        }
        button {
            font-size: 15px;
            border-radius: 5px;
        }
        button:hover {
            font-size: 16px;
        }
        div.register {
            position: absolute;
            right: 0;
            top: 0;
            padding: 5px;
        }
        a:link {
            color: white;
        }
        a:visited {
            color: white;
        }
        a:active {
            color: white;
        }
        div.register a:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
<?php
@ini_set('display_errors', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/scripts/fragments/appbars/appbar_not_auth_user.php');
$errors = [];
if (isset($_REQUEST['submit'])) {
    $user_name = $_REQUEST['name'];
    $user_password = $_REQUEST['password'];
    $authUser = new User($user_name,$user_password);
    try {
        if($user_result = $authUser->authorizeUser()){
            echo 'Добро пожаловать '.$authUser->getName();
            //сохранить данные в cookies и sessions
            try {
                $user_row = $user_result->fetch_assoc();
                $user_id = $user_row['user_id'];
                $time_to_expiring = 0; //сразу по закрытии страницы
                setcookie("user_id","$user_id",$time_to_expiring,"/","ignat.pr-host.ru");
                //var_dump($_COOKIE);
            }catch (UserException $exception) {
                $errors[] = $exception->getMessage();
                die();
            }
            $main_url = '/index.php';
            header('Location:'.$main_url);
        }
    }catch (UserException$exception) {
        $errors[] = $exception->getMessage();
    }
    ?>
    <p <?php if(count($errors)>0) {echo 'class="error"';}else{echo 'class="ok"';} ?> ><?php if(count($errors)>0){echo $errors[0];} else {echo "Ok";} ?></p>
    <hr>
    <form method="post" action=<?=$_SERVER['PHP_SELF']?> >
    <div class="all">
        <input id="name" type="text" name="name" <?="value='$user_name'"?> placeholder="Имя">
        <br>
        <br>
        <input id="password" type="password" name="password" <?="value='$user_password'"?> autocomplete="off" placeholder="Пароль">
        <br>
        <br>
        <button type="submit" name="submit">Авторизироваться</button>

        <div class="register">
            <a href= <?php echo 'registration.php';?>>Зарегистрироваться</a>
        </div>
    </div>
    </form>

    <?php
}else {
?>
<form method="post" action=<?=$_SERVER['PHP_SELF']?> >
<div class="all">
    <input id="name" type="text" name="name" maxlength="20" placeholder="Имя">
    <br>
    <br>
    <input id="password" type="password" name="password" autocomplete="off" maxlength="20" placeholder="Пароль">
    <br>
    <br>
    <button type="submit" name="submit">Авторизироваться</button>

    <div class="register">
        <a href= <?php echo 'registration.php';?>>Зарегистрироваться</a>
    </div>

</div>
</form>
</body>
<?php
}
?>
</html>
