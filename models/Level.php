<?php

namespace app\models;

use app\core\Model;

class Level extends Model
{
    public $table_name = 'd_levels';
    private $id;
    private $main_topic_id;
    private $name;
    private $technologies;
    private $questions;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setMainTopicId(int $main_topic_id)
    {
        $this->main_topic_id = $main_topic_id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }
    public function setTechs($technologies)
    {
        $this->technologies = $technologies;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getMainTopicId()
    {
        return $this->main_topic_id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getQuestions()
    {
        return $this->questions;
    }
    public function getTechs()
    {
        return $this->technologies;
    }

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