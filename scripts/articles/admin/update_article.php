<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
$chosenArticle = array();
$art_id = 2;
if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];
    echo $art_id;
if (!$chosenArticle = Article::getArticleById($_GET['art_id'])) {
die('Запрос не был отправлен');
}
}else {
$chosenArticle = Article::getArticleById(2);
}
$article_name = $chosenArticle['art_name'];
$article_theme = $chosenArticle['art_theme'];
$article_context = $chosenArticle['art_context'];
$article_author = $chosenArticle['user_name'];
$article_date = $chosenArticle['art_date'];
if(isset($_REQUEST['update'])) {
    $art_theme = $_REQUEST['article_theme'];
    $art_name = $_REQUEST['article_name'];
    $art_context = $_REQUEST['article_context'];
    $art_id = $_REQUEST['article_id'];
    Article::update_article($art_theme,$art_name,$art_context,$art_id);
    $main_url = 'http://'.$_SERVER['HTTP_HOST'].'/CourseProject/scripts'.'/main.php';
    header('Location:'.$main_url);

}
require_once($_SERVER['DOCUMENT_ROOT'] . '/CourseProject/html/admin/update_article_html.php');

?>
