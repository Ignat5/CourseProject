<!DOCTYPE html>
<html>

<head>
    <title>Регистрация</title>
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
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_not_auth_user.php');
$errors = [];
if(isset($_REQUEST['submit'])) {
    $user_name = $_REQUEST['name'];
    $user_password = $_REQUEST['password'];
    $newUser = new User($user_name,$user_password);
    try {
        $row_user = $newUser->addUser();
        $user_arr = $row_user->fetch_array();
        $user_id = $user_arr['user_id'];
        $time_to_expiring = 0; //сразу по закрытии страницы
        setcookie("user_id","$user_id",$time_to_expiring);
        $main_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/main.php';
        header('Location:'.$main_url);
    }catch (UserException $exception) {
        $errors[] = $exception->getMessage();
    }
    ?>
    <p <?php if(count($errors)>0) {echo 'class="error"';}else{echo 'class="ok"';} ?> ><?php if(count($errors)>0){echo $errors[0];} else {echo "Ok";} ?></p>
    <hr>
    <form method="post" action=<?=$_SERVER['PHP_SELF']?>>
        <div class="all">
            <input id="name" type="text" name="name" maxlength="15" <?="value='$user_name'"?> placeholder="Введите имя">
            <br>
            <br>
            <input id="password" type="password" name="password" maxlength="15" <?="value='$user_password'"?> autocomplete="off"  placeholder="Введите пароль">
            <br>
            <br>
            <button type="submit" name="submit">Зарегистрироваться</button>
        </div>
    </form>

<?php
    } else {
?>
<form method="post" action=<?=$_SERVER['PHP_SELF']?> >
<div class="all">
    <input id="name" type="text" maxlength="15" name="name" placeholder="Введите имя">
    <br>
    <br>
    <input id="password" type="password" name="password" maxlength="15" autocomplete="off" placeholder="Введите пароль">
<br>
    <br>
    <button type="submit" name="submit">Зарегистрироваться</button>
</div>
</form>

</body>
<?php } ?>
</html>