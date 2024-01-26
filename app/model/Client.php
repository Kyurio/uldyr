<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use app\database\Database;
use PDO;

class Client
{
    protected $db;
    protected $table = 'cliente';

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

    public function getLastInsertedId()
    {
        $stmt = $this->db->prepare("SELECT MAX(id) as last_id FROM " . $this->table);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return isset($result['last_id']) ? $result['last_id'] : null;
    }
}

?>