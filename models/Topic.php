<?php

namespace app\models;

use app\core\Model;

class Topic extends Model
{
    public $table_name = 'd_topics';
    public $questions_table = 'd_questions';
    public $technologies_table = 'r_technologies';
    public $levels_table = 'd_levels';
    private $id;
    private $alias;
    private $main_topic_id;
    private $name;
    private $technologies;
    private $levels;
    private $questions;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setAlias($alias)
    {
        $this->alias = $alias;
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
    public function setLevels($levels)
    {
        $this->levels = $levels;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAlias()
    {
        return $this->alias;
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
    public function getLevels()
    {
       return $this->levels;
    }

    public function findById(string $value) {
        $query = "SELECT * FROM $this->table_name WHERE id_topic='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function findByAuthor(int $value) {
        $query = "SELECT * FROM $this->table_name WHERE author_id='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function findAllQuestions() {
        $query = "SELECT * FROM $this->questions_table WHERE subtopic_id=" . $this->getId();

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }

        return $result ? $output : [];
    }

    public function findAllTechs() {
        $query = "SELECT DISTINCT d_technologies.id_tech, d_technologies.name
        FROM $this->technologies_table
        INNER JOIN $this->questions_table ON $this->technologies_table.question_id = $this->questions_table.id_question
        INNER JOIN d_technologies ON $this->technologies_table.technology_id = d_technologies.id_tech
        WHERE $this->questions_table.subtopic_id = " . $this->getId();

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function findAllLevels() {
        $query = "SELECT DISTINCT d_levels.id_level, d_levels.name
        FROM $this->questions_table
        INNER JOIN $this->levels_table ON $this->questions_table.level_id = $this->levels_table.id_level
        WHERE $this->questions_table.subtopic_id = " . $this->getId();

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function readMainTopics()
    {
        $query = "SELECT * FROM $this->table_name WHERE topic_id IS NULL";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }

        return $result ? $output : [];
    }

    public function readAllSubTopics()
    {
        $query = "SELECT * FROM $this->table_name WHERE topic_id IS NOT NULL";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }

        return $result ? $output : [];
    }

    public function readMainTopic($value)
    {
        $query = "SELECT * FROM $this->table_name WHERE id_topic=$value";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function readSubTopics($value)
    {
        $query = "SELECT * FROM $this->table_name WHERE topic_id=$value";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }

        return $result ? $output : [];
    }

    public function getTopictByAlias(string $alias, $main_topic) {
        $query = "SELECT * FROM d_topics WHERE alias = '$alias' AND topic_id=$main_topic";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getQuestionsCount($topic_id) {
        $query = "SELECT * FROM d_questions WHERE subtopic_id='$topic_id'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? count($output) : 0;
    }

    public function add($name, $main_topic, $author_id) {
        function transliterate($input) {
            $cyrillic = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];
            $latin = ['A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sch', '', 'Y', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya'];
            
            $output = str_replace($cyrillic, $latin, $input);
            $output = str_replace(' ', '-', $output);
            $output = strtolower($output);
            
            return $output;
        }

        $alias = transliterate($name);

        $query = "INSERT INTO d_topics (`name`, `topic_id`, `alias`, `author_id`) VALUES ('$name', '$main_topic', '$alias', '$author_id')";

        return $this->db->connection->query($query);
    }
}