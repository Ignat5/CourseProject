<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/Article.php');
$isPublished = Article::publish_article($_GET['art_id']);
if($isPublished) {
    $requests_url = '/scripts/articles/admin/check_requests.php';
    header('Location:'.$requests_url);
}else {
    echo 'Не удалось опубликовать статью';
}