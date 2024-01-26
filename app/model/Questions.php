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

    public function create($data)
    {

        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $stmt = $this->db->prepare("INSERT INTO " . $this->table . "(" . $columns . ") VALUES (" . $values . ")");
        $stmt->execute(array_values($data));

        return $this->db->lastInsertId();
    }


}

?>