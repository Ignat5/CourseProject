<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Connection.php');
class Article {
    private string $name;
    private string $theme;
    private string $context;
    private bool $isApproved;
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
    public static function getArticles() {
        $connection = Connection::getConnection();
        $query = "SELECT art_name,art_date,art_isApproved,art_id FROM articles";
        if($result = $connection->query($query)) {
                $result->fetch_all();
        }else {
            echo 'getArticles problem';
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
    public static function isArticleValid($article_theme,$article_name,$article_context) {
        if(trim($article_theme) == '' ||trim($article_name) == '' ||trim($article_context) == ''){
            throw new Exception('Заполните все поля!');
        }
    }
}
?>