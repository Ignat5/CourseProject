<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_auth_user.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Article.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Работа над статьей</title>
    <style>
        ::-webkit-input-placeholder {
            text-align: center;
        }
        .article_name{
            margin: 20px auto 10px auto;
            width: 50%;
            text-align: center;
        }

        .button{
            margin: 10px auto 15px auto;
            width: auto;
            text-align: center;

        }
        input.cl1{
            border-radius: 8px;
            /*visibility: visible;*/
            text-align: left;
            background-color: #E5E5E5;
            font-size: 20px;
            padding: 5px;
        }
        input.cl2{
            padding: 5px;
            border-radius: 8px;
            font-size: 20px;
            background-color: #E5E5E5;
        }
        select {
            text-align: center;
            margin: auto;
            visibility: visible;
            font-size: 20px;
            border-radius: 8px;
            background-color: #E5E5E5;
            width: 50%;
            text-align-last:center;
        }
        p.choose {
            margin: 0;
            padding: 0;
            opacity: 0.7;
        }
        .button{
            margin: 10px auto 15px auto;
            width: auto;
            text-align: center;
            font-size: 20px;
            border-radius: 8px;
        }
        button:hover {
            background-color: #333;
            color: white;
        }
        input.cl1:hover {
            /*font-size: 31px;*/
            width: 100%;
            background-color: #333;
            color: white;
        }
        input.cl2:hover {
            /*font-size: 31px;*/
            width: 100%;
            background-color: #333;
            color: white;
        }
        select:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form">
    <div class="article_name">
        <p class = "choose">выберите раздел</p>
        <select id="selectID" onclick="onClick()">
            <?php $allThemes = Article::getThemes();
            foreach ($allThemes as $theme) {
                echo '<option>'.$theme[0].'</option>';
            }
            ?>
        </select>
        <br>
        <br>
        <input  class="cl1" id="inputID" type="text" name="article_theme" placeholder="Раздел">
        <!-- <input  class="cl1" type="text" name="article_theme" placeholder="Тема"> -->
        <br><br>
        <input  class="cl2" type="text" name="article_name" placeholder="Название статьи">
    </div>

    <textarea id="textarea1" name="article_context" cols="100" rows="20"></textarea>

    <div class="button">
        <button id="createID" class="button" type="submit" name="create" >Предложить статью</button>
    </div>

</form>
<script>
    function onClickSwitch() {
        var p_switch = document.getElementById("p");
        var selectView = document.getElementById("selectID");
        var inputView = document.getElementById("inputID");
        if(p_switch.innerText == "Новая тема") {
            inputView.value = "hey";

            selectView.style.visibility = "hidden";
            inputView.style.visibility = "visible";
            p_switch.innerText = "Выбрать тему";
        }else {
            inputView.style.visibility = "hidden";
            selectView.style.visibility = "visible";
            p_switch.innerText = "Новая тема";
        }
    }
    function onClick() {
        var selectView = document.getElementById("selectID");
        var option = selectView.value;
        var inputView = document.getElementById("inputID");
        inputView.value = option;
    }
</script>

<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script type="text/javascript">
    var ckeditor = CKEDITOR.replace('article_context',{
        width:1500,height:300});
</script>
</body>
</html>
