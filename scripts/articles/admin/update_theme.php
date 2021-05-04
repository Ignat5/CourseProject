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
<div class="change">
<p id="change" class="change" onclick="show_input()">Изменить название раздела</p>
    <div id="change_inner" class="change_inner">
        <input id="input1" type="text" name="theme_name" placeholder="Новое название раздела">
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
    function show_input() {
        var input = document.getElementById("change_inner");
        input.style.display="inline-block";
    }
    function show_delete() {
        var btn_delete = document.getElementById("btn1");
        btn_delete.style.display="inline-block";
    }
</script>

<?php
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