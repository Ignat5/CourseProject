<?php
//Удаляем любую информацию, сохраненную о пользователе
session_start();
$_SESSION = array();
session_destroy();
setcookie("user_id","1",time()-3600);
$path_to_authorization_page = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/main.php';
header('Location:'.$path_to_authorization_page);