<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/Article.php');
Article::delete_article($_GET['art_id']);
$requests_url = '/scripts/articles/admin/check_requests.php';
header('Location:'.$requests_url);