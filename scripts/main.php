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
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
$allArticles = Article::getArticles();
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
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/show_info_article.php');
?>



</body>
