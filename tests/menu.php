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

    </style>

</head>

<body>

<div class="themes">
    <ul>
        <li><a href="#t1" onclick="showArticles(this)">Тема 1</a></li>
        <li><a href="#t2">Тема 2</a></li>
        <li><a href="#t3">Тема 3</a></li>
        <li><a href="#t4">Тема 4</a></li>
        <li><a href="#t5">Тема 5</a></li>
    </ul>
</div>

<div id="art" class="articles">
    <ul>
        <li><a href="#a1">Статья 1</a></li>
        <li><a href="#a2">Статья 2</a></li>
        <li><a href="#a3">Статья 3</a></li>
        <li><a href="#a4">Статья 4</a></li>
        <li><a href="#a5">Статья 5</a></li>
    </ul>
</div>

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

</div>

<script>
    function showArticles(elementID) {
        var articles = document.getElementById("art");
        if(articles.style.width=="20%") {
            articles.style.width = "0%";
            articles.style.visibility = "hidden";
        }
        else {
            articles.style.width = "20%";
            articles.style.visibility = "visible";
        }
        <?php ?>
    }
</script>


</body>

</html>
