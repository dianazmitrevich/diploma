<?php

namespace app\models;

use app\core\Model;
use app\models\User;

class Rating extends Model
{
    public $REG_BASE = 100;
    public $REG_BASE_RECR = 300;

    private $CONST_SUM = 11;
    
    private $LIKE_BASE = 7;
    private $VALIDATE_TOPIC_BASE = 10;
    private $VALIDATE_QUESTION_BASE = 14;

    public function getCoeffs($user_id) {
        $rating_cur = (new User)->findById($user_id)['rating'];
        $base_coeff = floor($rating_cur / 500);

        $this->LIKE_BASE -= $base_coeff;

        return [
            'LIKE_BASE' => $this->LIKE_BASE,
            'DISLIKE_BASE' => $this->CONST_SUM - $this->LIKE_BASE,
            'VALIDATE_TOPIC_BASE' => $this->VALIDATE_TOPIC_BASE,
            'VALIDATE_QUESTION_BASE' => $this->VALIDATE_QUESTION_BASE,
        ];
    }

    public function updateRating($user_id) {
        $finalRating = 0;

        $rating = $this->REG_BASE;

        $coeffs = $this->getCoeffs($user_id);

        // from rated replies
        $query = "SELECT *
        FROM d_rated
        INNER JOIN d_replies on d_replies.id_reply = d_rated.reply_id
        WHERE author_id='$user_id'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        foreach ($output as $key => $value) {
            switch ($value['parameter']) {
                case 'L': {
                    $finalRating += $coeffs['LIKE_BASE'];
                    break;
                }
                case 'D': {
                    $finalRating -= $coeffs['DISLIKE_BASE'];
                    break;
                }
            }
        }

        // from validated topics
        $query = "SELECT d_topics.author_id
        FROM d_validated
        INNER JOIN d_topics on d_topics.id_topic = d_validated.topic_id
        WHERE d_topics.author_id='$user_id'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        foreach ($output as $key => $value) {
            $finalRating += $coeffs['VALIDATE_TOPIC_BASE'];
        }

        // from validated questions
        $query = "SELECT d_questions.author_id
        FROM d_validated
        INNER JOIN d_questions on d_questions.id_question = d_validated.question_id
        WHERE d_questions.author_id='$user_id'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        foreach ($output as $key => $value) {
            $finalRating += $coeffs['VALIDATE_QUESTION_BASE'];
        }

        // final rating value
        $finalRating = $rating + $finalRating;

        $query = "UPDATE d_users SET `rating`='" . $finalRating . "' WHERE id_user=$user_id";

        return $this->db->connection->query($query);
    }
}