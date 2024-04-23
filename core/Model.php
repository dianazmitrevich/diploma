<?php

namespace app\core;

use app\lib\Database;

abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function readAll(string $table)
    {
        $query = "SELECT * FROM $table";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }

        return $result ? $output : [];
    }

    public function getById(string $table, int $id)
    {
        $query = "SELECT * FROM $table WHERE id = $id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function readAllWhere(string $table, string $key, $value)
    {
        $query = "SELECT * FROM $table WHERE $key=$value";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }

        return $result ? $output : [];
    }

    public function deleteById(string $table, int $id)
    {
        $query = "DELETE FROM $table WHERE id = $id";

        return $this->db->connection->query($query);
    }

}