<?php

namespace app\models;

use app\core\Model;

class TeamMember extends Model
{
    private $id;
    private $name;
    private $position;
    private $imageId;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setPosition(string $position)
    {
        $this->position = $position;
    }
    public function setImageId(int $imageId)
    {
        $this->imageId = $imageId;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPosition()
    {
        return $this->position;
    }
    public function getImageId()
    {
        return $this->imageId;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM ProjectTeam WHERE member_id = $id";
        $this->db->connection->query($query);


        $query = "DELETE FROM Team WHERE id = $id";

        return $this->db->connection->query($query);
    }

    public function edit(int $id, array $data)
    {
        $query = "UPDATE Team SET `name`='" . $data['name'] . "', `position`='" . $data['position'] . "', `image_id`=" . $data['memberImage'] . " WHERE id=$id";

        return $this->db->connection->query($query);
    }
    

    public function add(array $data)
    {
        $query = "INSERT INTO Team (`name`, `position`, `image_id`) VALUES ('" . $data['name'] . "', '" . $data['position'] . "', " . $data['teamImage'] . ")";

        $this->db->connection->query($query);
    }
}