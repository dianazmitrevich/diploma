<?php

namespace app\models;

use app\core\Model;

class Technology extends Model
{
    public $table_name = 'd_technologies';
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
}