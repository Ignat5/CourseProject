<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
Article::delete_article($_GET['art_id']);
$requests_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/check_requests.php';
header('Location:'.$requests_url);