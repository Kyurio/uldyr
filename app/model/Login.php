<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use app\database\Database;
use PDO;

class Login
{
    protected $db;
    protected $table = 'usuario';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {

        try {

            $stmt = $this->db->prepare("SELECT id_administrador, usuario, correo FROM " . $this->table);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function login($username, $password)
    {
        // Filtrar y validar el nombre de usuario y contraseña
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
    
        if (empty($username) || empty($password)) {
            return false; // Datos incompletos o inválidos
        }
    
        try {
            $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE Nombre_Usuario = :username AND Contrasena = :password");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
            // if ($user) {
            //     if (password_verify($password, $user['password'])) {
            //         return $user;
            //     }else{
            //         return false;
            //     }
            // }else{
            //     return false; 
            // }
    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function createUser($username, $password)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->db->prepare("INSERT INTO " . $this->table . " (username, password) VALUES (:username, :password)");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->execute();

            return $this->db->lastInsertId();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateUser($id, $newPassword)
    {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            $stmt = $this->db->prepare("UPDATE " . $this->table . " SET password = :password WHERE id = :id");
            $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->rowCount();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteUser($id)
    {
        try {

            $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (\Throwable $th) {
            return false;
        }
    }

}
