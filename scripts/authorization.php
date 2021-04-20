<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <style>
        .error {
            color: red;
            font-size: small;
            font-family: "Baskerville Old Face";
        }
        .ok {
            color: green;
            font-size: small;
            font-family: "Baskerville Old Face";
        }
    </style>
</head>

<body>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/User.php');
$errors = [];
if (isset($_REQUEST['submit'])) {

    $user_name = $_REQUEST['name'];
    $user_password = $_REQUEST['password'];
    $authUser = new User($user_name,$user_password);
    try {
        if($authUser->authorizeUser()){
            echo 'Добро пожаловать '.$authUser->getName();
            //$main_url = 'http://'.$_SERVER['HTTP_HOST'].'/CourseProject/main'.'/main.php';
            $main_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/main.php';
            header('Location:'.$main_url);
        }
    }catch (UserException$exception) {
        $errors[] = $exception->getMessage();
    }
    ?>
    <p <?php if(count($errors)>0) {echo 'class="error"';}else{echo 'class="ok"';} ?> ><?php if(count($errors)>0){echo $errors[0];} else {echo "Ok";} ?></p>
    <hr>
    <form method="post" action=<?=$_SERVER['PHP_SELF']?> >

        <label for="name">Ваше имя</label>
        <br>
        <input id="name" type="text" name="name" <?="value='$user_name'"?>>
        <br>
        <br>
        <label for="password">Ваш пароль</label>
        <br>
        <input id="password" type="password" name="password" <?="value='$user_password'"?> autocomplete="off">
        <br>
        <br>
        <button type="submit" name="submit">Авторизироваться</button>

    </form>
    <?php
}else {
?>
<p <?php if(count($errors)>0) {echo 'class="error"';}else{echo 'class="ok"';} ?> ><?php if(count($errors)>0){echo $errors[0];} else {echo "Ok";} ?></p>
<hr>
<form method="post" action=<?=$_SERVER['PHP_SELF']?> >

    <label for="name">Ваше имя</label>
    <br>
    <input id="name" type="text" name="name">
    <br>
    <br>
    <label for="password">Ваш пароль</label>
    <br>
    <input id="password" type="password" name="password" autocomplete="off">
    <br>
    <br>
    <button type="submit" name="submit">Авторизироваться</button>

</body>
<?php
}
?>
</html>
