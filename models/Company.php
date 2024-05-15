<?php

namespace app\models;

use app\core\Model;

class Company extends Model
{
    public function findById(string $value) {
        $query = "SELECT * FROM d_companies WHERE id_company='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }
}