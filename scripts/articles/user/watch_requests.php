<!DOCTYPE html>
<html>
<head>
    <title>Главная страница</title>
</head>

<style>
    a{
        text-decoration: none;
    }
    li{
        margin-top: 10px;
    }
    .div_menu {
        float: left;
        width: 20%;

        background-color: antiquewhite;
    }
</style>

<body>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_auth_user.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
session_start();
//$allArticles = Article::getArticles();
$allArticles = Article::getArticlesOfUser($_SESSION['user_id']);
echo '<div class="div_menu">';
echo '<ul style="list-style-type: none">';
foreach ($allArticles as $article) {
    echo '<li>'.'<a href = '.$_SERVER['PHP_SELF'].'?art_id='.$article['art_id'].'>'."{$article['art_name']}".'</a>'.'</li>';
}
echo '</ul>';
echo '</div>';
?>
<!--read_article.php-->
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/show_info_article_offers.php');
?>



</body>
