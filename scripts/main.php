<!DOCTYPE html>
<html>
<head>
    <title>Главная страница1</title>
</head>

<style>
    * {
        box-sizing: border-box;
    }

    a{
        text-decoration: none;
        margin: 0px;
    }
    li{
        margin-top: 0px;
    }

    ul.ul_menu li:last-child {
        color: gold;
        margin-bottom: 0px;
    }

    .div_menu {
        float: left;
        /*width: 150px;*/
        width: 15%;
        background-color: antiquewhite;
        text-align: left;
        /*max-width: 150px;*/
        display: inline-block;
        margin-top: 0px;
        padding: 0px;

        <!-- -->
    }
    ul {
        list-style-type: none;
    }
    li.theme {
        cursor: pointer;
        background-color: red;
        margin-bottom: 20px;
        font-size: 20px;
        padding: 0px;
        margin-top: 0px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    li.theme:hover {
        overflow: visible;
        text-overflow: unset;
        overflow-wrap: break-word;
        white-space: pre-line;
        padding-right: 15px;
    }
    li.collapse {
        cursor: pointer;
        background-color: aqua;
        text-align: center;
    }
    div.articles ul {
        background-color: #dddddd;
        /*display: inline-block;*/
        padding: 10px;
        margin-top: 0;
        margin: 0;
    }
    ul.ul_article li {
        background-color: darkgray;
        margin-top: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    ul.ul_article li:hover {
        background-color: red;
        overflow-wrap: break-word;
        text-overflow: unset;
        white-space: pre-line;
        /*word-break: break-all;*/

    }
    ul.ul_article li:first-child {
        margin-top: 0px;
    }
    .articles {
        visibility: hidden;
        background-color: teal;
        float: left;
        width: 0%;
        margin: 0px;
        font-size: 20px;
        left: 0;

    }
    .ul_menu {
        background-color: green;
        text-align: left;
        padding: 0px;
        margin: 0px;
    }

    li.theme a {
        background-color: lightskyblue;
    }


    @media only screen and (max-width: 1031px) {
            .ul_menu{
                background-color: blue;
            }
        li.theme {
            text-align: center;
        }
            .div_menu{width: 100%;}
            .articles{
                /*width: 100%;
                max-width: 100%;
                min-width: 100%;*/
                width: 100%;
                min-width: 100%;
                background-color: blue;
                text-align: center;
            }

    }
    @media only screen and (min-width: 1032px) {
        .articles {
            max-width: 20%;
            width: 20%;
            background-color: hotpink;
            text-align: left;
        }
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
        //echo 'Вы авторизированы, '.$_SESSION['user_name'].'<hr>';
    }catch (UserException $exception) {
        die($exception->getMessage());
    }
}else {
//user in not authorised
    //echo 'You are not authorized!';
}

if(isset($_SESSION['isAdmin'])) {
    if($_SESSION['isAdmin'] == 0) {
        require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_auth_user.php');
    }else {
        require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_admin.php');
    }

}else {
    require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_not_auth_user.php');
    //session_start();
    $_SESSION['isAdmin'] = 0;
}
//require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_not_auth_user.php');

$allThemes = Article::getThemes();
echo '<div class="div_menu">';
echo '<ul class = ul_menu>';
foreach ($allThemes as $theme) {
    echo '<li class="theme">' . '<a onclick="showArticles(this)">' . $theme[0] . '</a>' . '</li>';
}
echo '</ul>';
echo '</div>';

?>
<!--read_article.php-->
<?php if(isset($_GET['theme'])) {
    $articles_row = Article::getArticlesOfTheme($_GET['theme']);
    echo '<div id="art" class="articles">';
    echo '<ul class="ul_article">';
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
        <?php
        if($_SESSION['isAdmin']==1)  { ?>
        var context = document.getElementById("context");
        context.style.width = "65%";
        //alert('ok');

        //alert(window.innerWidth);
        <?php }else { ?>

        var context = document.getElementById("context");
        //alert('here');
        context.style.width = "65%";
        <?php } ?>
        var width = window.innerWidth;
        if(width>1031) {
            var articles = document.getElementById("art");
            articles.style.width = "20%";
            articles.style.visibility = "visible";
        }else {
            var articles = document.getElementById("art");
            articles.style.width = "100%";
            articles.style.visibility = "visible";
        }
    </script>

<?php
}
?>

<script>
    function showArticles(elementID) {
            var articles = document.getElementById("art");
            var theme_name = elementID.innerHTML;
            window.location.href = "main.php?art_id="+"<?php global $art_id; echo $art_id;?>" +"&theme=" + theme_name;

    }
    function collapseArticles() {
        var articles = document.getElementById("art");
        articles.style.display = "none";
        <?php if($_SESSION['isAdmin'] == 1) { ?>
        var context = document.getElementById("context");
        context.style.width = "85%";
        <?php } else { ?>
        var context = document.getElementById("context");
        context.style.width = "85%";
        <?php }?>
    }
</script>

</body>
</html>