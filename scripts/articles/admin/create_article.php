<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');

session_start();
if(isset($_SESSION['user_id'])) {
    $authorID = $_SESSION['user_id'];
    $isAdmin = $_SESSION['isAdmin'];
}else {
    die('По каким-то неведомым причинам вы не авторизированы, но попали сюда');
}
if(isset($_REQUEST['create'])) {
    $form_name = $_REQUEST['article_name'];
    $form_theme = $_REQUEST['article_theme'];
    $form_context = $_REQUEST['article_context'];
    //validation
    try {
        Article::isArticleValid($form_theme,$form_name,$form_context);
        $article = new Article($form_name,$form_theme,$form_context,$isAdmin,$authorID);
        $article->post_article();
        echo '<p style="color: green">'.'Статья успешно создана'.'</p>'.'<hr>';
    }catch (Exception $exception){
        echo '<p style="color: red">'.$exception->getMessage().'</p>'.'<hr>';
    }
}
if(isset($_REQUEST['create'])) {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/CourseProject/html/admin/create_article_html_saveInfo.php');
}else {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/CourseProject/html/admin/create_article_html.php');
}