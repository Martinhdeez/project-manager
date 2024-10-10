<?php
// Declaración de la clase user
class User {
    // Propiedades privadas para la conexión a la base de datos y el nombre de la tabla
    private $conn;
    private $table = 'users';
    
    // Propiedades públicas que representan los campos del usuario
    public $id;
    public $username;
    public $email;
    public $password;

    // Constructor que define una conexión a la base de datos y se le asigna a $conn
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un usuario
    public function register() {
        // Validaciones
        if (strlen($this->username) < 3 || strlen($this->username) > 40) {
            return "Username must be between 3 and 40 characters.";
        }

        if (!preg_match('/^[a-zA-Z0-9._]+$/', $this->username)) {
            return "Username can only contain letters, numbers, dots, and underscores.";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        if (strlen($this->password) < 8) {
            return "Password must be at least 8 characters long.";
        }

        if (!preg_match('/[A-Z]/', $this->password) || !preg_match('/[a-z]/', $this->password) || 
            !preg_match('/[0-9]/', $this->password) || !preg_match('/[\W]/', $this->password)) {
            return "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.";
        }

        // Hashear la contraseña
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        // Verificar si el usuario ya existe
        $check_sql = "SELECT * FROM " . $this->table . " WHERE username = ? OR email = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->execute([$this->username, $this->email]);

        if ($check_stmt->rowCount() > 0) {
            return "Username or email already exists.";
        }

        // Insertar nuevo usuario
        $sql = "INSERT INTO " . $this->table . " (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute([$this->username, $this->email, $hashed_password])) {
            return true;
        } else {
            return "Error: " . $stmt->errorInfo()[2];
        }
    }

    // Método para iniciar sesión
    public function login() {
        // Comprobar si existe el nombre de usuario
        $sql = "SELECT id, password FROM " . $this->table . " WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar la contraseña
            if (password_verify($this->password, $user['password'])) {
                $this->id = $user['id'];
                return true;
            } else {
                return "Incorrect password.";
            }
        } else {
            return "No account found with that username.";
        }
    }
}

