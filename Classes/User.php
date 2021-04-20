<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/exceptions/UserException.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/CourseProject/Classes/Connection.php');
class User {
    public static int $ROLE_ADMIN = 0;
    public static int $ROLE_AUTH_USER = 1;
    public static int $ROLE_NOT_AUTH_USER = 2;

    private string $username;
    private string $password;
    private int $role;

    public function __construct($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
        //$this->role = $role;
    }

    public function addUser() {
        $connection = Connection::getConnection();
        $this->isCorrect($this->username,$this->password);
        $this->isUnique($this->username);

        $query = "INSERT INTO users (user_name,user_password) VALUES('$this->username',SHA('$this->password'))";
        $result = $connection->query($query);
        $connection->close();
        return $result;
    }

    public function authorizeUser() {
        $this->isAuthOk();
        return true;
    }


    //check
    private function isUnique($name) {
        $connection = Connection::getConnection();
        $query="SELECT * FROM users WHERE user_name = '$this->username'";
        $result = $connection->query($query);
        $connection->close();
        if($result->num_rows > 0) {
            throw new UserException("Пользователь с таким именем уже зарегистрирован!",UserException::$CODE_UNIQUE);
        }
    }
    private function isCorrect($name,$password){
        if(trim($name)=="" || trim($password)=="") {
            throw new UserException("Заполните все поля!",UserException::$CODE_EMPTY);
        }
    }

    private function isAuthOk () {
        $connection = Connection::getConnection();
        if(trim($this->username)=="" || trim($this->password)=="") {
            throw new UserException("Заполните все поля!",UserException::$CODE_EMPTY);
        }
        //check is there a user in db with input_name
        $query_username = "SELECT COUNT(*) as user_count FROM users WHERE user_name = '$this->username'";
        $result = $connection->query($query_username);
        $row = $result->fetch_array();
        $count = intval($row['user_count']);
        if($count==0) {
            $connection->close();
            throw new UserException("Пользователь с таким именем не зарегистрирован!",UserException::$CODE_AUTH_NO_USER);
        }
        //check if input_password is right
        $query_password = "SELECT COUNT(*) as user_count FROM users WHERE user_name = '$this->username' && user_password=SHA('$this->password')";
        $result = $connection->query($query_password);
        $row = $result->fetch_array();
        $count = intval($row['user_count']);
        if($count==0) {
            $connection->close();
            throw new UserException("Неверный пароль!",UserException::$CODE_AUTH_WRONG_PASSWORD);
        }
    }

    //getters
    public function getName(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): int
    {
        return $this->role;
    }

}
?>