<?php

namespace app\models;

use app\core\Model;

class Question extends Model
{
    public $table_name = 'd_questions';
    public $technologies_table = 'r_technologies';
    public $replies_table = 'd_replies';
    private $id;
    private $completed;
    private $alias;
    private $main_topic_id;
    private $topic_id;
    private $name;
    private $technologies;
    private $level;
    private $replies;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setCompleted($bool) {
        $this->completed = $bool;
    }
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }
    public function setMainTopicId(int $main_topic_id)
    {
        $this->main_topic_id = $main_topic_id;
    }
    public function setTopic(int $topic_id)
    {
        $this->topic_id = $topic_id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setLevel($level)
    {
        $this->level = $level;
    }
    public function setTechs($technologies)
    {
        $this->technologies = $technologies;
    }
    public function setReplies($replies)
    {
        $this->replies = $replies;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getCompleted() {
        return $this->completed;
    }
    public function getAlias()
    {
        return $this->alias;
    }
    public function getMainTopicId()
    {
        return $this->main_topic_id;
    }
    public function getTopic()
    {
        return $this->topic_id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getLevel()
    {
        return $this->level;
    }
    public function getTechs()
    {
        return $this->technologies;
    }
    public function getReplies()
    {
        return $this->replies;
    }

    public function isCompleted() {
        $query = "SELECT * FROM d_completed WHERE question_id=" . $this->getId();

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? ($output ? true : false) : [];
    }

    public function findById(string $value) {
        $query = "SELECT * FROM $this->table_name WHERE id_question='$value'";

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

    public function findByAlias(string $value) {
        $query = "SELECT * FROM $this->table_name WHERE alias='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }


    public function findAllTechnologies($value)
    {
        $query = "SELECT * FROM $this->technologies_table WHERE question_id=$value";

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


    public function getFilteredQuestions() {
        $query = "SELECT DISTINCT $this->technologies_table.technology_id, $this->technologies_table.question_id, $this->table_name.name, $this->table_name.created_at, d_levels.id_level, d_levels.name as level_name, d_users.username, d_users.rating, d_users.avatar
        FROM $this->technologies_table
        INNER JOIN $this->table_name ON $this->technologies_table.question_id = $this->table_name.id_question
        INNER JOIN d_levels ON d_levels.id_level = $this->table_name.level_id
        INNER JOIN d_users ON d_users.id_user = $this->table_name.author_id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getQuestions() {
        $query = "SELECT DISTINCT $this->technologies_table.question_id, $this->table_name.name, $this->table_name.created_at, $this->table_name.alias, d_levels.id_level, d_levels.name as level_name, d_users.username, d_users.rating, d_users.avatar, d_topics.alias as main_topic_alias
        FROM $this->technologies_table
        INNER JOIN $this->table_name ON $this->technologies_table.question_id = $this->table_name.id_question
        INNER JOIN d_levels ON d_levels.id_level = $this->table_name.level_id
        INNER JOIN d_topics ON d_topics.id_topic = $this->table_name.subtopic_id
        INNER JOIN d_users ON d_users.id_user = $this->table_name.author_id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getTechnologiesList($id = null)
    {
        if ($id == NULL) {
            $id = $this->getId();
        }

        $query = "SELECT DISTINCT d_technologies.id_tech, d_technologies.name
            FROM $this->technologies_table
            INNER JOIN d_technologies ON d_technologies.id_tech = $this->technologies_table.technology_id
            WHERE question_id=" . $id;

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }
        
        return $result ? $output : [];
    }

    public function getQuestiontByAlias(string $alias) {
        $query = "SELECT * FROM $this->table_name WHERE alias = '$alias'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getRepliesList()
    {
        $query = "SELECT DISTINCT d_replies.id_reply, d_replies.text, d_replies.rating, d_replies.created_at, d_users.avatar, d_users.username, d_users.rating as user_rating
        FROM $this->replies_table
        INNER JOIN d_users ON d_replies.author_id = d_users.id_user
        WHERE question_id=" . $this->getId();

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);

        }
        
        return $result ? $output : [];
    }

    public function add($name, $description, $level_id, $subtopic_id, $author_id, $alias) {
        $query = "INSERT INTO d_questions (`name`, `description`, `level_id`, `subtopic_id`, `author_id`, `alias`) VALUES ('$name', '$description', '$level_id', '$subtopic_id', '$author_id', '$alias')";

        return $this->db->connection->query($query);
    }


    // private $id;
    // private $imageId;

    // public function setId(int $id)
    // {
    //     $this->id = $id;
    // }
    // public function setImageId(int $imageId)
    // {
    //     $this->imageId = $imageId;
    // }

    // public function getId()
    // {
    //     return $this->id;
    // }
    // public function getImageId()
    // {
    //     return $this->imageId;
    // }

    // public function delete(int $id)
    // {
    //     $query = "DELETE FROM Technologies WHERE technology_id = $id";
    //     $this->db->connection->query($query);


    //     $query = "DELETE FROM TechnologiesList WHERE id = $id";

    //     return $this->db->connection->query($query);
    // }

    // public function edit(int $id, array $data)
    // {
    //     $query = "UPDATE TechnologiesList SET `image_id`=" . $data['techImage'] . " WHERE id=$id";

    //     return $this->db->connection->query($query);
    // }

    // public function add(array $data)
    // {
    //     $query = "INSERT INTO TechnologiesList (`image_id`) VALUES (" . $data['techImage'] . ")";

    //     $this->db->connection->query($query);
    // }
}