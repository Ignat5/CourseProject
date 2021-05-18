<?php
class Connection {
    private static $hostname = "localhost";
    private static $username = "ignat";
    private static $password = "dP4hK6bN8buJ9s";
    private static $database = "ignat";

    public static function getConnection() {
        $connection = new mysqli(Connection::$hostname,Connection::$username,Connection::$password,Connection::$database);
        if($connection->connect_error) {
            die('Connection failed '.$connection->connect_error);
        }else {
            return $connection;
        }
    }


}