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
}