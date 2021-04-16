<?php

class User {
    public static int $ROLE_ADMIN = 0;
    public static int $ROLE_AUTH_USER = 1;
    public static int $ROLE_NOT_AUTH_USER = 2;

    private string $username;
    private string $password;
    private int $role;

    public function __construct($username,$password,$role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

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