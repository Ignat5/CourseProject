<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-size: 18px;
            padding-top: 40px;
            background-color: lightblue;
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
            margin: 0;
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
        div.appbar{
            margin-left: -10px;
        }


    </style>
</head>
<body>

<div class="appbar">
    <ul>
        <li><a class="home" href="/CourseProject/scripts/main.php">Главная</a></li>
        <li style="float: right"><a href="/CourseProject/scripts/authorization.php">Авторизироваться</a></li>
    </ul>
</div>