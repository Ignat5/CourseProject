<!DOCTYPE html>
<html>
<head>
    <style>

        body {
            font-size: 18px;
            padding-top: 50px;
            margin-bottom: 0px;
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
            /*max-width: 100%;*/
            /*max-width: 100%;
            min-width: 850px;*/
        }

        div.appbar li {
            float: left;
            margin: 0px;
            /*max-width: 400px;
            min-width: 150px;*/
            /*background-color: red;*/
        }

        div.appbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            margin: 0px;
        }

        div.appbar li a:hover {
            background-color: #111;
        }
        @media only screen and (min-width: 500px) {

        }


    </style>
</head>
<body>

<div class="appbar">
<ul>
    <li><a class="active" href="/index.php">Главная</a></li>
    <li><a href="/scripts/articles/admin/create_article.php">Создать статью</a></li>
    <li><a href="/scripts/articles/admin/check_requests.php">Посмотреть запросы пользователей</a></li>
    <li style="float: right"><a href="/scripts/logout.php">Выйти из аккаунта</a></li>
</ul>
</div>

