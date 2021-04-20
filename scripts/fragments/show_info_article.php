<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
$chosenArticle = array();
if(isset($_GET['art_id'])) {
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read</title>
    <style>
        .center {
            text-align: center;
            margin: auto;
            background-color: darkgray;
            float: left;
            width: 70%;
        }
        .change {
            float: left;
            width: 10%;
            background-color: darkcyan;
        }
    </style>
</head>
<body>
<?php global $article_theme; global $article_name; global $article_date; global $article_context; global $article_author;?>


<div class="center">
    <h2><?php echo 'Тема статьи: '.$article_theme?></h2>
    <h3><?php echo 'Название статьи: '.$article_name?></h3>
    <h5><?php echo 'Дата публикации: '.$article_date?></h5>

     <!-- <textarea id="textarea1" name="article_context" disabled="disabled" cols="100" rows="20"></textarea> -->
    <hr>
    <p><?php echo $article_context?></p>
    <hr>
    <h4><?php echo 'Автор статьи: '.$article_author?></h4>
</div>

<div class="change">
    <a href="#change">Редактировать статью</a> <br><br>
    <a href="#delete">Удалить статью</a>
</div>

</body>

</html>