<!DOCTYPE html>
<html>
<head>
    <title>Главная страница</title>
</head>

<style>
    * {
        box-sizing: border-box;
    }
    a{
        text-decoration: none;
    }
    li{
        margin-top: 10px;
        text-align: center;
    }
    li.articles {
        padding: 0;
        margin: 0;
    }
    ul {
        padding: 0;
    }
    .div_menu {
        float: left;
        width: 20%;
        border-right: 2px solid white;
        border-bottom: 2px solid white;
        text-align: left;
        display: inline-block;
        margin-top: 0px;
        padding: 0px;

        /*background-color: antiquewhite;*/
    }
    b {
        font-size: 15px;
    }

    b.accepted {
        color: green;
    }
    b.notAccepted {
        color: red;
    }
    pre.message {
        margin: 0;
        padding: 0;
        text-align: center;
        font-size: 20px;
    }
    a:link {
        color: white;
    }
    a:visited {
        color: white;
    }

    a:active {
        color: white;
    }
    @media only screen and (max-width: 1031px) {
       .div_menu {
           width: 100%;
       }
    }

</style>

<body>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
session_start();
//$allArticles = Article::getArticles();
//$allArticles = Article::getArticlesOfUser($_SESSION['user_id']);
$allArticles = Article::getRequestedArticles();
echo '<div class="div_menu" id="div1">';
echo '<ul style="list-style-type: none">';
foreach ($allArticles as $article) {
    echo '<li class="articles">'.'<a href = '.$_SERVER['PHP_SELF'].'?art_id='.$article['art_id'].'>'."{$article['art_name']}".'</a>'.'</li>';
}
/*if(!$allArticles->num_rows) {
    echo 'Нет предложенных статей';
}*/
echo '</ul>';
echo '</div>';
if (!$allArticles->num_rows) {?>
    <script>
        var div = document.getElementById("div1");
        div.style.display="none";
    </script>
    <pre class="message">
        Запросы пользователей отсутствуют.
        Если кто-то из пользователей предложит вам свою статью к публикации,
        она отобразится на данной странице.
    </pre>
<?php
}

?>
<!--read_article.php-->
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/show_info_article_offers.php');
?>

</body>