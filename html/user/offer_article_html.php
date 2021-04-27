<?php require_once($_SERVER['DOCUMENT_ROOT'].'/CourseProject/scripts/fragments/appbars/appbar_auth_user.php');?>
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
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form">


    <div class="article_name">
        <input  class="cl1" type="text" name="article_theme" placeholder="Тема"><br><br>
        <input  class="cl1" type="text" name="article_name" placeholder="Название статьи">
    </div>

    <textarea id="textarea1" name="article_context" cols="100" rows="20">Some text here</textarea>

    <div class="button">
        <button class="button" type="submit" name="create" >Предложить статью</button>
    </div>

</form>

<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script type="text/javascript">
    var ckeditor = CKEDITOR.replace('article_context');
</script>
</body>
</html>