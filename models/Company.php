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

    public function findByName(string $name) {
        $query = "SELECT * FROM d_companies WHERE name='$name'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getAll() {
        $query = "SELECT * FROM d_companies";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function add($name) {
        $query = "INSERT INTO d_companies (`name`) VALUES ('$name')";

        return $this->db->connection->query($query);
    }
}