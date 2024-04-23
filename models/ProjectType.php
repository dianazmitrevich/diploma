<?php

namespace app\models;

use app\core\Model;

class ProjectType extends Model
{
    private $id;
    private $name;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM ProjectTypes WHERE id = $id";

        return $this->db->connection->query($query);
    }

    public function edit(int $id, array $data)
    {
        $query = "UPDATE ProjectTypes SET `name`='" . $data['name'] . "' WHERE id=$id";

        return $this->db->connection->query($query);
    }

    public function add(array $data)
    {
        $query = "INSERT INTO ProjectTypes (`name`) VALUES ('" . $data['name'] . "')";

        $this->db->connection->query($query);
    }
}