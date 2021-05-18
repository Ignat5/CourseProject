<?php
//Удаляем любую информацию, сохраненную о пользователе
session_start();
$_SESSION = array();
session_destroy();
setcookie("user_id","1",time()-3600,"/","ignat.pr-host.ru");
$path_to_authorization_page = '/index.php';
header('Location:'.$path_to_authorization_page);