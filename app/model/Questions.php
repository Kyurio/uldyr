<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use app\database\Database;
use PDO;

class Questions
{
    protected $db;
    protected $table = 'pregunta';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function GetAll()
    {
        try {

            $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function create($data)
    {

        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $stmt = $this->db->prepare("INSERT INTO " . $this->table . "(" . $columns . ") VALUES (" . $values . ")");
        $stmt->execute(array_values($data));

        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        try {
            $sets = array();
            foreach ($data as $key => $value) {
                $sets[] = $key . "=?";
            }

            $stmt = $this->db->prepare("UPDATE " . $this->table . " SET " . implode(',', $sets) . " WHERE id = ?");
            $stmt->execute(array_merge(array_values($data), array($id)));

            if ($stmt->rowCount()) {
                return true;
            } else {
                return false;
            }
            
        } catch (\Throwable $th) {
            // Lanza la excepción para que pueda ser manejada en el lugar donde llamaste a la función
            throw new \Exception("Error al actualizar la base de datos: " . $th->getMessage());
        }
    }

    public function delete($id)
    {

        try {
        
            $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id_icono = ?");
            $stmt->execute(array($id));
    
            return $stmt->rowCount();
        
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
