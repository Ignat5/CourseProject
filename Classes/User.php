<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/Classes/exceptions/UserException.php');
//require_once ($_SERVER['DOCUMENT_ROOT'].'/CourseProject_v2/Classes/Connection.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Classes/Connection.php');
class User {
    public static  $ROLE_ADMIN = 0;
    public static  $ROLE_AUTH_USER = 1;
    public static  $ROLE_NOT_AUTH_USER = 2;

    private $username;
    private  $password;
    private  $role;

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

        $query_getID = "SELECT user_id FROM users WHERE user_name='$this->username'";
        $result_id = $connection->query($query_getID);
        if(!($result) ||!($result_id)) {
            throw new UserException("Ошибка при регистрации",UserException::$CODE_INSERT);
        }
        $connection->close();
        return $result_id;
    }

    public function authorizeUser() {
        $this->isAuthOk();
        //get user's id
        $connection = Connection::getConnection();
        $query_getID = "SELECT user_id FROM users WHERE user_name='$this->username'";
        $result_id = $connection->query($query_getID);
        if(!($result_id)) {
            throw new UserException("Ошибка при регистрации",UserException::$CODE_INSERT);
        }
        $connection->close();
        return $result_id;

    }

    public static function getUserById ($user_id) {
        $connection = Connection::getConnection();
        $query = "SELECT user_id,user_name,isAdmin FROM users WHERE user_id=$user_id";
        $result = $connection->query($query);
        if (!$result) {
            throw new UserException("Ошибка при получении id",UserException::$CODE_SELECT_ID);
        }
        $row = $result->fetch_assoc();
        $connection->close();
        return $row;
    }


    //check addUser
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
    //check authorizeUser
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
    public function getName()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

}
?>