<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-size: 18px;
            padding-top: 50px;
        }

        div.appbar ul {
            list-style-type: none;
            border-bottom: 2px solid white;
            margin: 0px;
            padding: 0px;
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            min-width: 900px;
        }

        div.appbar li {
            float: left;
        }
        div.appbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1;
            border-bottom: 2px solid white;

            /*width: 100px;*/
            /*overflow: hidden;*/
            /*min-width: 900px;*/
        }

        div.appbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        div.appbar li a:hover {
            background-color: #111;
        }


    </style>
</head>
<body>

<div class="appbar">
    <ul>
        <li><a class="active" href="/index.php">Главная</a></li>
        <li><a href="/scripts/articles/user/offer_article.php">Предложить статью</a></li>
        <li><a href="/scripts/articles/user/watch_requests.php">Посмотреть мои запросы</a></li>
        <li style="float: right"><a href="/scripts/logout.php">Выйти из аккаунта</a></li>
    </ul>
</div>
