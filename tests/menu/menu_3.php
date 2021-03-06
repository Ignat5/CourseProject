<!DOCTYPE html>
<html>
<head>
    <title>Главная страница1</title>
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
        width: 10%;
        background-color: antiquewhite;
    }
    ul {
        list-style-type: none;
    }
    li.theme {
        cursor: pointer;
    }
    li.collapse {
        cursor: pointer;
    }
    .articles {
        visibility: hidden;
        background-color: teal;
        float: left;
        width: 0%;
    }
</style>

<body>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
if(isset($_COOKIE['user_id'])) {
//get user by his id and set sessions
    try {
        $user_row = User::getUserById(intval($_COOKIE['user_id'])); //ассоц массив с данными пользователя
        //save user's data in session
        session_start();
        $_SESSION['user_id'] = $user_row['user_id'];
        $_SESSION['user_name'] = $user_row['user_name'];
        $_SESSION['isAdmin'] = $user_row['isAdmin'];
        echo 'Вы авторизированы, '.$_SESSION['user_name'].'<hr>';
    }catch (UserException $exception) {
        die($exception->getMessage());
    }
}else {
//user in not authorised
    echo 'You are not authorized!';
}

if(isset($_SESSION['isAdmin'])) {
    if($_SESSION['isAdmin'] == 0) {
        require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_auth_user.php');
    }else {
        require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_admin.php');
    }

}else {
    require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_not_auth_user.php');
}


//require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_not_auth_user.php');

$allThemes = Article::getThemes();
echo '<div class="div_menu">';
    echo '<ul>';
foreach ($allThemes as $theme) {
    echo '<li class="theme">' . '<a onclick="showArticles(this)">' . $theme[0] . '</a>' . '</li>';
}
echo '</ul>';
echo '</div>';
/*$allArticles = Article::getArticles();
echo '<div class="div_menu">';
echo '<ul style="list-style-type: none">';
foreach ($allArticles as $article) {
    echo '<li>'.'<a href = '.$_SERVER['PHP_SELF'].'?art_id='.$article['art_id'].'>'."{$article['art_name']}".'</a>'.'</li>';
}
echo '</ul>';
echo '</div>';*/
?>
<!--read_article.php-->


<?php if(!isset($_GET['theme'])) {
    ?>
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
            echo '<li>'.'<a href = '.$_SERVER['PHP_SELF'].'?art_id='.intval($article[1]).'>'."{$article[0]}".'</a>'.'</li>';
        }
        echo '<li class="collapse" onclick="collapseArticles()">свернуть</li>';
        echo '</ul>';
        echo '</div>';
    }
    require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/show_info_article_main.php');
if(isset($_GET['theme'])) {
?>
    <script>
        <?php if($_SESSION['isAdmin']==2) { ?>
        var context = document.getElementById("context");
        context.style.width = "60%";
        <?php } else { ?>

        var context = document.getElementById("context");
        context.style.width = "70%";
        <?php } ?>
    var articles = document.getElementById("art");
    articles.style.width = "20%";
    articles.style.visibility = "visible";
</script>
  <?php
}
?>
<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/show_info_article_main.php');
?>


<script>
    function showArticles(elementID) {
        var articles = document.getElementById("art");
        if (articles.style.width == "20%") {
            //alert('articles are open now');
            var theme_name = elementID.innerHTML;
            window.location.href = "menu_3.php?theme=" + theme_name;
        }else{
            //alert('articles are closed now');
            var theme_name = elementID.innerHTML;
            window.location.href = "menu_3.php?theme=" + theme_name;
        }
    }
    function collapseArticles() {
        var articles = document.getElementById("art");
        articles.style.width = "0%";
        articles.style.visibility = "hidden";
        var context = document.getElementById("context");
        context.style.width = "90%";
    }

</script>

</body>