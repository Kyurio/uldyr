<?php

namespace app\model;

require_once __DIR__ . '/../database/database.php';

use app\database\Database;
use PDO;

class Data
{
    protected $db;
    protected $table = 'data';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function GetQuestion($pregunta)
    {
        try {
            $pregunta = $this->normalizeText($pregunta);

            $stmt = $this->db->prepare("SELECT pregunta, respuesta FROM " . $this->table);
            $stmt->execute();

            $bestMatch = null;
            $maxMatchingKeywords = 0;

            while ($question = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $currentMatchingKeywords = $this->countMatchingKeywords($pregunta, $this->normalizeText($question['pregunta']));

                if ($currentMatchingKeywords > $maxMatchingKeywords) {
                    $maxMatchingKeywords = $currentMatchingKeywords;
                    $bestMatch = $question;
                }
            }

            // If there is a match, return the result as an array
            if ($bestMatch) {
                return $bestMatch;
            } else {
                // Handle the case when no match is found (return an empty array, or customize as needed)
                return [];
            }

        } catch (\PDOException $e) {
            // Log the error or throw a custom exception
            throw new \Exception("Error in the query: " . $e->getMessage());
        }
    }

    private function normalizeText($text)
    {
        return strtolower($text);
    }

    private function countMatchingKeywords($pregunta1, $pregunta2)
    {
        $keywords1 = preg_split('/\s+/', $pregunta1, -1, PREG_SPLIT_NO_EMPTY);
        $keywords2 = preg_split('/\s+/', $pregunta2, -1, PREG_SPLIT_NO_EMPTY);

        $matchingKeywords = array_intersect($keywords1, $keywords2);

        return count($matchingKeywords);
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