<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
$chosenArticle = array();
//$art_id = 2;
if($_SESSION['isAdmin'] == 0) {
    if($article_user = Article::getDefaultArticleOfUser($_SESSION['user_id'])) {
    $art_id = $article_user['art_id'];
}else {
        die('');
    }
}
if($_SESSION['isAdmin'] == 1) {
    if($article_row = Article::getDefaultRequestedArticle()) {
        $art_id = $article_row['art_id'];
    }else {
        die(); // нет предложенных статей

    }
}

if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];
    if (!$chosenArticle = Article::getArticleById($_GET['art_id'])) {
        die('Запрос не был отправлен');
    }
}else {
    $chosenArticle = Article::getArticleById($art_id);
    //echo $art_id;
}
$article_name = $chosenArticle['art_name'];
$article_theme = $chosenArticle['art_theme'];
$article_context = $chosenArticle['art_context'];
$article_author = $chosenArticle['user_name'];
$article_date = $chosenArticle['art_date'];
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
        body {
            background-color: #333;
            color: white;
        }
        .center {
            text-align: center;
            margin: 0px;
            /*background-color: darkgray;*/
            float: left;
            width: 80%;
            position: relative;
            border-left: 2px solid white;
            border-bottom: 2px solid white;
            color: ghostwhite;
            opacity: 0.9;
            /*border-right: 2px solid white;*/
        <?php if($role!=2) {echo 'width: 80%';} ?>
        }
        div.inner {
            position: relative;
            background-color: red;
        }
        .change {
            position: absolute;
            top: 0;
            float: left;
            width: 100%;
            /*background-color: darkcyan;*/
            padding: 5px;
        }
        a.last {
            position: absolute;
            right: 0;
            color: white;
            opacity: 0.7;
        }
        a.first {
            position: absolute;
            left: 0;
            color: white;
            opacity: 0.7;
        }
        a.first:hover {
            opacity: 0.9;
        }
        a.last:hover {
            opacity: 0.9;
        }

        @media only screen and (max-width: 1031px) {
            .center {
                width: 100%;
                border-right: 2px solid white;
            }

        }

    </style>
</head>
<body>
<?php global $article_theme; global $article_name; global $article_date; global $article_context; global $article_author;?>


<div class="center">
    <h2><?php echo 'Раздел статьи: '.$article_theme?></h2>
    <h3><?php echo 'Название статьи: '.$article_name?></h3>
    <h5><?php echo 'Дата публикации: '.$article_date?></h5>

    <!-- <textarea id="textarea1" name="article_context" disabled="disabled" cols="100" rows="20"></textarea> -->
    <hr>
    <p><?php echo $article_context?></p>
    <hr>
    <h4><?php echo 'Автор статьи: '.$article_author?></h4>
<?php
if($_SESSION['isAdmin']) {
    $path_publish = '/CourseProject/scripts/articles/admin/publish_requested_article.php'
    .'?art_id='.$art_id;
    $path_delete = '/CourseProject/scripts/articles/admin/delete_requested_article.php'
        .'?art_id='.$art_id;
    echo '<div class = "change">';
    echo '<div class="inner">';
    echo '<a href="'.$path_publish.'" class="first">Опубликовать статью</a>';
    echo '<a href="'.$path_delete.'" class="last">Отклонить статью</a>';
    echo '</div>';
    echo '</div>';
}
    ?>
</div>
</body>

</html>