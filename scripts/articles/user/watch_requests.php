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
echo '<ul style="list-style-type: none">';
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
    <p style="background-color: teal">SOMETHING HERE WHEN THERE IS NO OFFERS</p>
<?php
}
?>
<!--read_article.php-->
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/show_info_article_offers.php');
?>

</body>
