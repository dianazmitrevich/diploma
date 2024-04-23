<?php

namespace app\models;

use app\core\Model;

class Completed extends Model
{
    private $id;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function add($question_id, $user_id) {
        $query = "INSERT INTO d_completed (`question_id`, `user_id`) VALUES ('$question_id', '$user_id')";

        return $this->db->connection->query($query);
    }

    public function remove($question_id, $user_id) {
        $query = "DELETE FROM d_completed WHERE question_id=$question_id AND user_id=$user_id";

        return $this->db->connection->query($query);
    }

    public function getCompleted($user_id) {
        $query = "SELECT d_levels.name as level_name, d_users.username, d_users.avatar, d_users.rating, d_completed.question_id, d_completed.user_id, d_questions.name, d_questions.created_at, d_questions.alias, d_topics.alias as subtopic_alias
        FROM d_completed
        INNER JOIN d_questions ON d_completed.question_id=d_questions.id_question
        INNER JOIN d_topics ON d_topics.id_topic = d_questions.subtopic_id
        INNER JOIN d_levels ON d_levels.id_level = d_questions.level_id
        INNER JOIN d_users ON d_users.id_user = d_questions.author_id
        WHERE user_id=$user_id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }
}