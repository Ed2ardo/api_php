<?php
//  define el modelo de usuario que incluye métodos para registro y verificación de inicio de sesión.
class User
{
    private $conn;
    private $table = "users"; #tabla a consultar, validar, guardar

    public $id;
    public $username;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register()
    {
        $query = "INSERT INTO " . $this->table . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password);
        // Hash the password
        // si se ingresa desde phpMyAdmin nos damos cuenta que no codifica la contraseña.

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) { // Verify hashed password
            return true;
        }
        return false;
    }
}
