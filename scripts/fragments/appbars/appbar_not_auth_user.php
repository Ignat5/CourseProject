<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-size: 18px;
            padding-top: 40px;
            margin-bottom: 0px;
            /*background-color: lightblue;*/
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
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1;
            border-bottom: 2px solid white;
        }


    </style>
</head>
<body>

<div class="appbar">
    <ul>
        <li><a class="home" href="/index.php">Главная</a></li>
        <li style="float: right"><a href="/scripts/authorization.php">Авторизироваться</a></li>
    </ul>
</div>