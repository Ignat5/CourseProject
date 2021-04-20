<?php

class Connection {
    private static string $hostname = "localhost";
    private static string $username = "ignat";
    private static string $password = "CourageandDementia";
    private static string $database = "portal";

    public static function getConnection():mysqli {
        $connection = new mysqli(Connection::$hostname,Connection::$username,Connection::$password,Connection::$database);
        if($connection->connect_error) {
            die('Connection failed '.$connection->connect_error);
        }else {
            return $connection;
        }
    }


}