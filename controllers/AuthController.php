<?php
// maneja la lógica para el registro e inicio de sesión.
include_once('./config/Database.php');
include_once('./models/User.php');

class AuthController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register($username, $password)
    {
        $this->user->username = $username;
        $this->user->password = $password;
        return $this->user->register();
    }

    public function login($username, $password)
    {
        $this->user->username = $username;
        $this->user->password = $password;
        return $this->user->login();
    }
}
