<?php

namespace app\models;

use app\core\Model;

class Medialibrary extends Model
{
    private $id;
    private $imageSrc;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setSrc(string $name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getSrc()
    {
        return $this->name;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM Medialibrary WHERE id = $id";
        unlink('controllers/uploads/' . $this->getById('Medialibrary', $id)['imageSrc']);

        return $this->db->connection->query($query);
    }

    public function add(string $src)
    {
        $query = "INSERT INTO `Medialibrary` (`imageSrc`) VALUES ('" . $src . "')";

        return $this->db->connection->query($query);
    }
}