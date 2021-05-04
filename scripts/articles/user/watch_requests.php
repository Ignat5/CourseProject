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
    b {
        font-size: 15px;
    }

    b.accepted {
        color: green;
    }
    b.notAccepted {
        color: red;
    }
    ul.ul_articles li {
        /*background-color: lightskyblue;*/
    }
    ul.ul_articles {
        /*background-color: lightpink;*/
        margin: 0;
        padding: 0;
        padding-left: 5px;
    }
    pre.message {
        text-align: center;
    }

    @media only screen and (max-width: 1031px) {
        .div_menu{
            width: 100%;
            text-align: center;
        }

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
$number_rows =  $allArticles->num_rows;
if($number_rows!=0) {
echo '<div class="div_menu">';
echo '<ul style="list-style-type: none" class="ul_articles">';
$status = '';
$class = '';
foreach ($allArticles as $article) {
    if($article['art_isApproved'] == 0) {$status = 'не одобрена';$class='notAccepted';}else {$status = 'одобрена'; $class='accepted';}
    echo '<li>'.'<a href = '.$_SERVER['PHP_SELF'].'?art_id='.$article['art_id'].'>'."{$article['art_name']} ".
        "<b class = '$class'".">{$status}</b>".'</a>'.'</li>';
}

echo '</ul>';
echo '</div>';
}else {
    ?>
    <pre class="message">
        Вы не предложили ни одной статьи,
            либо все ваши запросы были отклонены.

           Каждая одобренная статья или статья,
          находящаяся на стадии рассмотрения,
        будет отображена данной странице.
    </pre>
<?php
}
?>
<!--read_article.php-->
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/show_info_article_offers.php');
?>

</body>
