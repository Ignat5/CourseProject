<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/scripts/fragments/appbars/appbar_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Classes/Article.php');

if(isset($_REQUEST['add'])||isset($_REQUEST['change'])||isset($_REQUEST['delete'])) {
    $main_url = '/index.php';
    header('Refresh:2; '.$main_url,true,303);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Разделы</title>
    <style>
        select {
            text-align: center;
            margin: auto;
            visibility: visible;
            font-size: 30px;
            width: 100%;
        }
        div.article_name {
            text-align: center;
            font-size: 30px;
        }
        p.change {
            /*background-color: lightskyblue;*/
            display: inline-block;
            margin-right: 20px;
            cursor: pointer;
        }
        div.change{
            /*background-color: lightpink;*/
        }
        div.change_inner {
            display: none;
            /*background-color: lightblue;*/
            width: 100%;
            margin-bottom: 50px;
        }
        p.choose {
            text-align: center;
            margin: 0;
            font-size: 20px;
            margin-bottom: 3px;
            opacity: 0.7;
        }
        p.delete {
            /*background-color: lightskyblue;*/
            display: inline-block;
            cursor: pointer;
            margin-right: 20px;
        }
        div.delete {
            /*background-color: lightpink;*/
        }
        button.delete {
            display: none;
        }
        input.cl1 {
            display: none;
        }

        div.addNewTheme{
            background-color: hotpink;
            text-align: left;
        }
        div.addNewTheme p{
            display: inline-block;
            /*background-color: lightskyblue;*/
            margin-right: 45px;
        }
        div.option {
            text-align: center;
            display: none;
        }
        div.all {
            text-align: center;
            font-size: 30px;
        }
        input {
            font-size: 30px;
            padding: 5px;
            width: 90%;
            border-radius: 8px;
        }
        button {
            font-size: 19px;
            border-radius: 5px;
        }
        select:hover {
            font-size: 31px;
        }
        button:hover {
            font-size: 20px;
        }
        /*p:hover {
            font-size: 31px;
        }*/
        p.change:hover {
            font-size: 31px;
        }
        p.delete:hover {
            font-size: 31px;
        }

    </style>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form">
    <div class="all">
    <div id="optionID" class="option">
    <p class="choose">Выберите раздел для редактирования</p>
        <div class="article_name">
            <select id="selectID" onclick="onClick()">
            <option style="display: none"></option>
            <?php $allThemes = Article::getThemes();
            foreach ($allThemes as $theme) {
                echo '<option>'.$theme[0].'</option>';
            }
            ?>
            </select>
            <input class="cl1" id="inputID" type="text" name="article_theme_name" placeholder="Тема">
        </div>
    </div>

    <div class="change">
        <p id="add" class="change" onclick="show_add()">Добавить пустой раздел</p>
        <div id="add_inner" class="change_inner">
            <input id="input_add" type="text" name="theme_name_add" placeholder="Название пустого раздела">
            <button type="submit" name="add">Добавить</button>
        </div>
    </div>
<hr>
<div class="change">
<p id="change" class="change" onclick="show_input()">Изменить название раздела</p>
    <div id="change_inner" class="change_inner">
        <input id="input1" type="text" name="theme_name" placeholder="Новое название раздела">
        <button type="submit" name="change">Изменить</button>
    </div>
</div>
        <hr>
    <div class="delete">
        <p class="delete" onclick="show_delete()">Удалить раздел</p>
        <button id="btn1" class="delete" type="submit" name="delete">Удалить</button>
    </div>

    </div>

</form>
<script>
    function onClick() {
        //var p_switch = document.getElementById("p");
        var selectView = document.getElementById("selectID");
        var option = selectView.value;
        var inputView = document.getElementById("inputID");
        inputView.value = option;
    }
    function show_add() {
        var input = document.getElementById("add_inner");
        var input_update = document.getElementById("change_inner");
        var option = document.getElementById("optionID");
        var btn_delete = document.getElementById("btn1");
        if(input.style.display == "inline-block") {
            input.style.display="none";
        } else {
            input.style.display = "inline-block";
            input_update.style.display="none";
            option.style.display = "none";
            btn_delete.style.display="none";
        }
    }
    function show_input() {
        var input = document.getElementById("change_inner");
        var option = document.getElementById("optionID");
        var input_add = document.getElementById("add_inner");
        var btn_delete = document.getElementById("btn1");
        if(input.style.display == "inline-block") {
            input.style.display="none";
            option.style.display = "none";
        } else {
            input.style.display = "inline-block";
            option.style.display = "inline-block";
            input_add.style.display="none";
            btn_delete.style.display="none";
        }
    }
    function show_delete() {
        var btn_delete = document.getElementById("btn1");
        var option = document.getElementById("optionID");
        var input_add = document.getElementById("add_inner");
        var input_update = document.getElementById("change_inner");
        if(btn_delete.style.display == "inline-block") {
            btn_delete.style.display="none";
            option.style.display = "none";
        }else {
            btn_delete.style.display = "inline-block";
            option.style.display = "inline-block";
            input_add.style.display="none";
            input_update.style.display="none";
        }
    }
</script>

<?php
if(isset($_REQUEST['add'])) {
    $blank_theme_name = $_REQUEST['theme_name_add'];
    if(trim($blank_theme_name)=='') {
        echo '<p style="color: red">Название раздела не может быть пустым. Добавление отклонено.</p>';
        return;
    }
    if(Article::isThemeUnique($blank_theme_name)) {
        Article::addBlankTheme($blank_theme_name,$_COOKIE['user_id']);
        echo '<p style="color: green">Пустой раздел'.'<b style="font-size: 20px">'." $blank_theme_name ".'</b>'.'создан.</p>';
    }else {
        echo '<p style="color: red">Раздел с таким именем уже существует. Добавление отклонено.</p>';
        return;
    }

}
if(isset($_REQUEST['change'])) {
    $old_theme_name = $_REQUEST['article_theme_name'];
    $new_theme_name = $_REQUEST['theme_name'];
    if(trim($old_theme_name)=='') {
        echo '<p style="color: red">Не был выбран раздел. Изменение отклонено.</p>';
        return;
    }
    if(trim($new_theme_name)=='') {
        echo '<p style="color: red">Название раздела не может быть пустым. Изменение отклонено.</p>';
        return;
    }
    if(Article::isThemeUnique($new_theme_name)) {
        Article::changeNameOfTheme($old_theme_name,$new_theme_name);
        echo '<p style="color: green">Изменение произведено: '."$old_theme_name ".'>>'.'<b style="font-size: 20px">'." $new_theme_name ".'</b></p>';

    }else {
        echo '<p style="color: red">Раздел с таким именем уже существует. Изменение отклонено.</p>';
        return;
    }
}
if(isset($_REQUEST['delete'])) {
    $theme_name = $_REQUEST['article_theme_name'];
    if(trim($theme_name)=='') {
        echo '<p style="color: red">Не был выбран раздел. Удаление отклонено.</p>';
        return;
    }
    if(Article::deleteTheme($theme_name)) {
        echo '<p style="color: green">Раздел'.'<b style="font-size: 20px">'." $theme_name ".'</b>'.'удален.</p>';
        return;
    }
}
?>
</body>
</html>
