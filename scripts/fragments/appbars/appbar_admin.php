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
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
        }

        div.appbar li {
            float: left;
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
    <li><a class="active" href="/CourseProject/scripts/main.php">Главная</a></li>
    <li><a href="/CourseProject/scripts/articles/admin/create_article.php">Создать статью</a></li>
    <li><a href="/CourseProject/scripts/articles/admin/check_requests.php">Посмотреть запросы пользователей</a></li>
    <li style="float: right"><a href="/CourseProject/scripts/logout.php">Выйти из аккаунта</a></li>
</ul>
</div>

