<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/Article.php');
if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];
    Article::delete_article($art_id);

    $main_url = '/index.php';
    header('Location:'.$main_url);
}else {
    echo 'wtf?';
}
