<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];
    Article::delete_article($art_id);

    $main_url = 'http://'.$_SERVER['HTTP_HOST'].'/CourseProject/scripts'.'/main.php';
    header('Location:'.$main_url);
}else {
    echo 'wtf?';
}
