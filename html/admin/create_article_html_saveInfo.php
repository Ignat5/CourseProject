<?php require_once('/var/www/vitas/data/www/ignat.pr-host.ru/scripts/fragments/appbars/appbar_admin.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Работа над статьей</title>
    <style>
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
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php global $form_theme,$form_name,$form_context;?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form">


    <div class="article_name">
        <input  class="cl1" type="text" value= "<?php echo $form_theme;?>" name="article_theme" placeholder="Тема"><br><br>
        <input  class="cl1" type="text" value="<?php echo $form_name;?>" name="article_name" placeholder="Название статьи">
    </div>

    <textarea id="textarea1" name="article_context" cols="100" rows="20"><?php echo $form_context;?></textarea>

    <div class="button">
        <button class="button" type="submit" name="create" >Создать статью</button>
    </div>

</form>

<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script type="text/javascript">
    var ckeditor = CKEDITOR.replace('article_context');
</script>
</body>
</html>