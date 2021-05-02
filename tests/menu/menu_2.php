<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
$allThemes = Article::getThemes();
//$allArticles = Article::getArticlesOfTheme('Коты');
//var_dump($allArticles);
//var_dump($allThemes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
    <!--
        1.  Нужно будет изменять width полей с помощью php в зависимости от того, показывается
          область со статьями или нет
         2. Также можно сделать вот что: позволить создавать новые темы (разделы) только админу,
           а пользователям предлагать статьи только по уже существующим темам - давать им
           выбор из например выпадающего списка-->
    <style>
        ul {
            list-style-type: none;
        }
        .themes {
            background-color: lightpink;
            float: left;
            width: 10%;
        }
        li{
            margin-bottom: 15px;
        }
        .articles {
            visibility: hidden;
            background-color: teal;
            float: left;
            width: 0%;
        }
        .content {
            background-color: darkgray;
            float: left;
            width: auto;
        }
        li.collapse {
            font-size: 15px;
            margin-top: 30px;
            cursor: pointer;
        }
        li.theme {
            cursor: pointer;
        }

    </style>

</head>

<body>

<div class="themes">
    <ul>
        <?php
        foreach ($allThemes as $theme) {
            echo '<li class="theme">'.'<a onclick="showArticles(this)">'.$theme[0].'</a>'.'</li>';
        }
        ?>
    </ul>
</div>
<?php if(!isset($_GET['theme'])) { ?>
<div id="art" class="articles">
    <ul>
        <li><a href="#a1">Статья 1</a></li>
        <li><a href="#a2">Статья 2</a></li>
        <li><a href="#a3">Статья 3</a></li>
        <li><a href="#a4">Статья 4</a></li>
        <li><a href="#a5">Статья 5</a></li>
        <li class="collapse" onclick="collapseArticles()">свернуть</li>
    </ul>
</div>
<?php
    } else {
    $articles_row = Article::getArticlesOfTheme($_GET['theme']);
    echo '<div id="art" class="articles">';
    echo '<ul>';
    $allArticles = Article::getArticlesOfTheme($_GET['theme']);
    foreach ($allArticles as $article) {
        echo '<li>'.'<a href="#art">'.$article[0].'</a>'.'</li>';
    }
    echo '<li class="collapse" onclick="collapseArticles()">свернуть</li>';
    echo '</ul>';
    echo '</div>';
}
    ?>

<?php

if(isset($_GET['theme'])) {
    /*echo 'yep';

    $articles_row = Article::getArticlesOfTheme($_GET['theme']);
    var_dump($articles_row);
    echo '<div id="art" class="articles">';
    echo '<ul>';
    $allArticles = Article::getArticlesOfTheme($_GET['theme']);
    foreach ($allArticles as $article) {
        echo '<li>'.'<a href="#art">'.$article[0].'</a>'.'</li>';
    }
    echo '</ul>';
    echo '</div>';*/
    ?>
    <script>
        var articles = document.getElementById("art");
        articles.style.width = "20%";
        articles.style.visibility = "visible";
    </script>

    <?php
}



/*<div id="art" class="articles">
    <ul>
        <li><a href="#a1">Статья 1</a></li>
        <li><a href="#a2">Статья 2</a></li>
        <li><a href="#a3">Статья 3</a></li>
        <li><a href="#a4">Статья 4</a></li>
        <li><a href="#a5">Статья 5</a></li>
        <li class="collapse" onclick="collapseArticles()">свернуть</li>
    </ul>
</div>*/
?>

<div class="content">

<textarea rows="50" cols="100">
Lorem ipsum dolor sit amet, consectetur adipiscing elit,
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    Ut enim ad minim veniam, quis nostrud exercitation ullamco
    laboris nisi ut aliquip ex ea commodo consequat.
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum
</textarea>

    <script>
        function showArticles(elementID) {
            var articles = document.getElementById("art");
            if (articles.style.width == "20%") {
                //alert('articles are open now');
                var theme_name = elementID.innerHTML;
                window.location.href = "menu_2.php?theme=" + theme_name;
            }else{
                    //alert('articles are closed now');
                    var theme_name = elementID.innerHTML;
                    window.location.href = "menu_2.php?theme=" + theme_name;
                }
            }
        function collapseArticles() {
            var articles = document.getElementById("art");
            articles.style.width = "0%";
            articles.style.visibility = "hidden";
        }
    </script>


</div>