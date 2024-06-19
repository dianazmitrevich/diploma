<?php

namespace app\models;

use app\core\Model;

class Technology extends Model
{
    public $table_name = 'd_technologies';

    public function findById($value)
    {
        $query = "SELECT * FROM $this->table_name WHERE id_tech=$value";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getTechsList() {
        $query = "SELECT * FROM $this->table_name";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function addBulk($data, $id) {
        $query = "INSERT INTO r_technologies (`technology_id`, `question_id`) VALUES ";

        foreach ($data as $key => $value) {
            $query .= "('$value', '$id'),";
        }

        $query = substr($query, 0, -1);

        return $this->db->connection->query($query);
    }

    public function add($data) {
        $query = "INSERT INTO d_technologies (`name`) VALUES ";
    
        foreach ($data as $key => $value) {
            $query .= "('$value'),";
        }
    
        $query = substr($query, 0, -1);

        if ($this->db->connection->query($query)) {
            $last_id = $this->db->connection->insert_id;
            $added_rows = [];
            for ($i = $last_id - count($data) + 1; $i <= $last_id; $i++) {
                $result = $this->db->connection->query("SELECT * FROM d_technologies WHERE id_tech = $i");
                $row = $result->fetch_assoc();
                $added_rows[] = $row['id_tech'];
            }
            return $added_rows;
        } else {
            return false;
        }
    }
    
}