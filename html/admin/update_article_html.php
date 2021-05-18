<?php require_once('/var/www/vitas/data/www/ignat.pr-host.ru/scripts/fragments/appbars/appbar_admin.php');
?>
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
<?php global $article_theme,$article_name,$article_date,$article_context,$article_author,$art_id?>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form">


    <div class="article_name">
        <input  class="cl1" type="text" value="<?php echo $article_theme;?>" name="article_theme" placeholder="Тема"><br><br>
        <input  class="cl1" type="text" value="<?php echo $article_name;?>" name="article_name" placeholder="Название статьи">
        <h3>Дата публикации: <?php echo $article_date ?></h3>
    </div>
        <div>
    <textarea id="textarea1"  name="article_context" rows="1"  ><?php echo $article_context;?></textarea>
        </div>

    <input type="text" name="article_id" value="<?php echo $art_id;?>" hidden="hidden">

    <div class="button">
        <button class="button" type="submit" name="update" >Изменить статью</button>
        <h3 style="margin-top: 20px">Автор: <?php echo $article_author;?></h3>
    </div>

</form>

<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script type="text/javascript">
    var ckeditor = CKEDITOR.replace('article_context',{
       width:1500,height:700});

</script>
</body>
</html>
