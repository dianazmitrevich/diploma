<?php

namespace app\models;

use app\core\Model;

class Level extends Model
{
    public $table_name = 'd_levels';
    
    public function findById($value)
    {
        $query = "SELECT * FROM $this->table_name WHERE id_level=$value";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getLevelsList() {
        $query = "SELECT * FROM $this->table_name";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }
}