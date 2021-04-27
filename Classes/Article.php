<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Connection.php');
class Article {
    private string $name;
    private string $theme;
    private string $context;
    private int $isApproved;
    private int $authorID;

    function __construct($name,$theme,$context,$isApproved,$authorID) {
        $this->name = $name;
        $this->theme = $theme;
        $this->context = $context;
        $this->isApproved = $isApproved;
        $this->authorID = $authorID;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getTheme(): string
    {
        return $this->theme;
    }
    public function getContext(): string
    {
        return $this->context;
    }
    public function getIsApproved():bool {
        return $this->isApproved;
    }
    public function getAuthorID(): int
    {
        return $this->authorID;
    }

    public function post_article() {
        $connection = Connection::getConnection();
        $query = "INSERT INTO articles (art_name,art_theme,art_context,art_isApproved,art_authorID,art_date)"
            ." VALUES('$this->name','$this->theme','$this->context',$this->isApproved,$this->authorID,CURRENT_DATE())";
        if($connection->query($query)) {
        }else {echo 'Data was NOT inserted!';}
        $connection->close();
    }
    public static function update_article($art_theme,$art_name,$art_context,$art_id) {
        $connection = Connection::getConnection();
        $query = "UPDATE articles SET art_name = '$art_name',art_theme = '$art_theme',art_context = '$art_context',art_date = CURRENT_DATE() WHERE art_id = $art_id";
        if($connection->query($query)) {}
        else {
            $connection->close();
            die('Не удалось обновить статью');
        }
        $connection->close();

    }
    public static function delete_article ($art_id) {
        $connection = Connection::getConnection();
        $query = "DELETE FROM articles WHERE art_id = $art_id";
        $result = $connection->query($query);
        if(!$result) {
            die('Не удалось удалить статью');
        }
        $connection->close();
    }
    public static function publish_article ($art_id) {
        $connection = Connection::getConnection();
        $query = "UPDATE articles SET art_date = CURRENT_DATE(),art_isApproved = 1 WHERE art_id = $art_id";
        $result = $connection->query($query);
        $connection->close();
        return $result;
    }



    public static function getArticles() {
        $connection = Connection::getConnection();
        $query = "SELECT art_name,art_date,art_isApproved,art_id FROM articles WHERE art_isApproved = 1";
        if($result = $connection->query($query)) {
                $result->fetch_all();
        }else {
            echo 'getArticles problem';
        }
        $connection->close();
        return $result;
    }
    public static function getDefaultArticle() {
        $connection = Connection::getConnection();
        $query = "SELECT art_name,art_theme,art_context,art_date,art_id,users.user_name FROM articles INNER JOIN users ON users.user_id = art_authorID WHERE art_isApproved = 1";
        $result = $connection->query($query);
        $connection->close();
        if($result) {
            $row = $result->fetch_assoc();
            return $row;
        }else {return false;}
    }
    public static function getArticlesOfUser($userID) {
        $connection = Connection::getConnection();
        $query = "SELECT art_name,art_date,art_isApproved,art_id FROM articles WHERE art_authorID = $userID";
        if($result = $connection->query($query)) {
            $result->fetch_all();
        }else {
            echo 'getArticlesOfUser problem';
        }
        $connection->close();
        return $result;
    }
    public static function getArticleById($article_id) {
        $connection = Connection::getConnection();
        $query = "SELECT art_name,art_theme,art_context,art_date,users.user_name FROM articles ".
                 "INNER JOIN users ON users.user_id = art_authorID WHERE art_id = $article_id";
        if($result = $connection->query($query)) {
            $result = $result->fetch_assoc();
        }else {
            echo 'getArticleById problem';
            return false;
        }
        $connection->close();
        return $result;
    }
    public static function getRequestedArticles() {
        $connection = Connection::getConnection();
        $query = "SELECT art_name,art_date,art_isApproved,art_id FROM articles WHERE art_isApproved = 0";
        if($result = $connection->query($query)) {
            $result->fetch_all();
        }else {
            echo 'getArticlesOfUser problem';
        }
        $connection->close();
        return $result;
    }
    public static function getDefaultRequestedArticle() {
        $connection = Connection::getConnection();
        $query = "SELECT art_name,art_date,art_isApproved,art_id FROM articles WHERE art_isApproved = 0";
        if($result = $connection->query($query)) {
            $row = $result->fetch_assoc();
        }else {
            echo 'getArticlesOfUser problem';
            $row = false;
        }
        $connection->close();
        return $row;
    }
    public static function getDefaultArticleOfUser($userID) {
        $connection = Connection::getConnection();
        $query = "SELECT art_id FROM articles WHERE art_authorID = $userID LIMIT 1";
        if($result = $connection->query($query)) {
            $result = $result->fetch_assoc();
            $connection->close();
            return $result;
        }else {
            echo 'getDefaultArticleOfUser problem';
        }
        $connection->close();
    }
    public static function isArticleValid($article_theme,$article_name,$article_context) {
        if(trim($article_theme) == '' ||trim($article_name) == '' ||trim($article_context) == ''){
            throw new Exception('Заполните все поля!');
        }
    }
}
?>