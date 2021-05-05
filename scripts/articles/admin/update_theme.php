<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Работа над статьей</title>
    <style>
        select {
            text-align: center;
            margin: auto;
            visibility: visible;
        }
        div.article_name {
            text-align: center;
        }
        p.change {
            background-color: lightskyblue;
            display: inline-block;
            margin-right: 20px;
            cursor: pointer;
        }
        div.change{
            background-color: lightpink;
        }
        div.change_inner {
            display: none;
        }
        p.choose {
            text-align: center;
            margin: 0;
            margin-bottom: 15px;
        }
        p.delete {
            background-color: lightskyblue;
            display: inline-block;
            cursor: pointer;
            margin-right: 20px;
        }
        div.delete {
            background-color: lightpink;
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
            background-color: lightskyblue;
            margin-right: 45px;
        }
        div.add_inner {

        }

    </style>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form">
    <p class="choose">Выберите раздел для редактирования</p>
    <div class="article_name">
        <!--<p id="p" class="switch" onclick="onClickSwitch()">Новая тема</p> -->
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

   <!-- <div class="addNewTheme">
            <p onclick="">Добавить пустой раздел</p>
            <div class="add_inner" id="div2">
                <input type="text" placeholder="Название пустого раздела">
                <button type="submit" name="add">Добавить</button>
            </div>
        </div> -->
    <div class="change">
        <p id="add" class="change" onclick="show_add()">Добавить пустой раздел</p>
        <div id="add_inner" class="change_inner">
            <input id="input_add" type="text" name="theme_name_add" placeholder="Название пустого раздела">
            <button type="submit" name="add">Добавить</button>
        </div>
    </div>

<div class="change">
<p id="change" class="change" onclick="show_input()">Изменить название раздела</p>
    <div id="change_inner" class="change_inner">
        <input id="input1" type="text" name="theme_name" placeholder="Название нового раздела">
        <button type="submit" name="change">Изменить</button>
    </div>
</div>
    <div class="delete">
        <p class="delete" onclick="show_delete()">Удалить раздел</p>
        <button id="btn1" class="delete" type="submit" name="delete">Удалить</button>
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
        if(input.style.display == "inline-block") {
            input.style.display="none";
        } else {
            input.style.display = "inline-block";
        }
    }
    function show_input() {
        var input = document.getElementById("change_inner");
        if(input.style.display == "inline-block") {
            input.style.display="none";
        } else {
            input.style.display = "inline-block";
        }
    }
    function show_delete() {
        var btn_delete = document.getElementById("btn1");
        if(btn_delete.style.display == "inline-block") {
            btn_delete.style.display="none";
        }else {
            btn_delete.style.display = "inline-block";
        }
    }
</script>

<?php
if(isset($_REQUEST['add'])) {
    $blank_theme_name = $_REQUEST['theme_name_add'];
    echo $blank_theme_name.'<hr>';
    echo $_COOKIE['user_id'];
    if(Article::addBlankTheme($blank_theme_name,$_COOKIE['user_id'])) {
        echo 'ok';
    }
}
if(isset($_REQUEST['change'])) {
    $old_theme_name = $_REQUEST['article_theme_name'];
    $new_theme_name = $_REQUEST['theme_name'];
    if(Article::changeNameOfTheme($old_theme_name,$new_theme_name)) {
        echo 'ok';
        //header('main')
    }
}
if(isset($_REQUEST['delete'])) {
    $theme_name = $_REQUEST['article_theme_name'];
    if(Article::deleteTheme($theme_name)) {
        echo 'ok';
        //header('main')
    }
}

?>

</body>
</html>