<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
$chosenArticle = array();
//$art_id = 2;
if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];
    if (!$chosenArticle = Article::getArticleById($_GET['art_id'])) {
        die('Запрос не был отправлен');
    }
}else {
    //$chosenArticle = Article::getArticleById(2);
    if($chosenArticle = Article::getDefaultArticle()) {
    }else {die('Не удалось получить дефолтную статью');}
}
$article_name = $chosenArticle['art_name'];
$article_theme = $chosenArticle['art_theme'];
$article_context = $chosenArticle['art_context'];
$article_author = $chosenArticle['user_name'];
$article_date = $chosenArticle['art_date'];
if (isset($chosenArticle['art_id'])) {
    $art_id = $chosenArticle['art_id'];
}
/// role: 0-not_auth, 1-auth, 2-admin
$role = 0;
if(!isset($_SESSION['user_name'])) {
    $role = 0;
}else if($_SESSION['isAdmin'] == 0) {
    $role = 1;
}else {$role = 2;}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read</title>
    <style>

        .center {
            text-align: center;
            margin: 0px;
            background-color: darkgray;
            float: left;
            width: 85%;
            position: relative;
            overflow: hidden;
            min-width: 85%;
            /*min-width: 40%;*/
            <?php if($_SESSION['isAdmin']==0){ echo 'width:90%';} ?>
        <?php //if($role!=2) {echo 'width: 80%';} ?>

        }
        .change {
            width: 25%;
            background-color: darkcyan;
            right: 0;
            position: absolute;
            top: 0;
        }
        @media only screen and (max-width: 1031px) {
            .center{
                width: 100%;
                min-width: 100%;
            }
            .change{width: 100%;}
        }
        /*@media only screen and (min-width: 1031px) {
            .center{
                width: 65%;
                min-width: 65%;
            }
        }*/
    </style>
</head>
<body>
<?php global $article_theme; global $article_name; global $article_date; global $article_context; global $article_author;?>


<div id="context" class="center">
    <br>
    <h2><?php echo 'Тема статьи: '.$article_theme?></h2>
    <h3><?php echo 'Название статьи: '.$article_name?></h3>
    <h5><?php echo 'Дата публикации: '.$article_date?></h5>

    <!-- <textarea id="textarea1" name="article_context" disabled="disabled" cols="100" rows="20"></textarea> -->
    <hr>
    <p><?php echo $article_context?></p>
    <hr>
    <h4><?php echo 'Автор статьи: '.$article_author?></h4>

    <?php
    if($role == 2) {
        //admin
        $path_update = '/CourseProject/scripts/articles/admin/update_article.php'.
            '?art_id='.$art_id;
        $path_delete = '/CourseProject/scripts/articles/admin/delete_article.php'.
            '?art_id='.$art_id;

        echo '<div class = "change">';
        echo '<a href='.$path_update.'>Редактировать статью</a>'.'<hr>';
        echo '<a href='.$path_delete.'>Удалить статью</a>'.'<hr>';
        echo '</div>';
    }
    ?>

</div>


</body>

</html>