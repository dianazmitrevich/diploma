<?php

namespace app\models;

use app\core\Model;
use app\models\Rating;

class Reply extends Model
{
    private $id;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRating($id) {
        return ['new_rating_l' => $this->findById($id)['rating_l'], 'new_rating_d' => $this->findById($id)['rating_d']];
    }

    public function canRate($user_id, $reply_id, $parameter) {
        $query = "SELECT * FROM d_rated WHERE reply_id='$reply_id' AND user_id='$user_id' AND parameter='$parameter'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $output ? false : true;
    }

    public function isReplyRated($reply_id, $user_id) {
        $query = "SELECT * FROM d_rated WHERE reply_id='$reply_id' AND user_id='$user_id'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function rate($reply_id, $user_id, $action) {
        $rating = 0;
        $ratedReply = [];
        $reply = [];

        $query = "SELECT * FROM d_rated WHERE reply_id='$reply_id' AND user_id='$user_id'";
        if ($result = $this->db->connection->query($query)) {
            $ratedReply = $result->fetch_assoc();
        }

        $query = "SELECT * FROM d_replies WHERE id_reply='$reply_id'";
        if ($result = $this->db->connection->query($query)) {
            $reply = $result->fetch_assoc();
        }

        if (!$ratedReply) {
            $query = "INSERT INTO d_rated (`reply_id`, `user_id`, `parameter`) VALUES ('$reply_id', '$user_id', '$action')";
            $this->db->connection->query($query);

            switch ($action) {
                case 'L': {
                    $rating = $reply['rating_l'] + 1;
                    $query = "UPDATE d_replies SET `rating_l`='" . $rating . "' WHERE id_reply=$reply_id";
                    $this->db->connection->query($query);
                    break;
                }
                case 'D': {
                    $rating = $reply['rating_d'] + 1;
                    $query = "UPDATE d_replies SET `rating_d`='" . $rating . "' WHERE id_reply=$reply_id";
                    $this->db->connection->query($query);
                    break;
                }
            }
        } else {
            if ($ratedReply['parameter'] === $action) {
                switch ($ratedReply['parameter']) {
                    case 'L': {
                        $rating = $reply['rating_l'] - 1;
                        $query = "UPDATE d_replies SET `rating_l`='" . $rating . "' WHERE id_reply=$reply_id";
                        $this->db->connection->query($query);
                        break;
                    }
                    case 'D': {
                        $rating = $reply['rating_d'] - 1;
                        $query = "UPDATE d_replies SET `rating_d`='" . $rating . "' WHERE id_reply=$reply_id";
                        $this->db->connection->query($query);
                        break;
                    }
                }

                $query = "DELETE FROM d_rated WHERE reply_id=$reply_id AND user_id=$user_id";
                $this->db->connection->query($query);
            } else if ($ratedReply['parameter'] !== $action) {
                switch ($action) {
                    case 'L': {
                        $rating_l = $reply['rating_l'] + 1;
                        $rating_d = $reply['rating_d'] - 1;
                        break;
                    }
                    case 'D': {
                        $rating_l = $reply['rating_l'] - 1;
                        $rating_d = $reply['rating_d'] + 1;
                        break;
                    }
                }

                $query = "UPDATE d_replies SET `rating_l`='" . $rating_l . "', `rating_d`='" . $rating_d . "' WHERE id_reply=$reply_id";
                $this->db->connection->query($query);

                $query = "UPDATE d_rated SET `parameter`='" . $action . "' WHERE reply_id=$reply_id";
                $this->db->connection->query($query);
            }
        }

        return (new Rating)->updateRating($reply['author_id']);
    }
    
    public function findById(string $value) {
        $query = "SELECT * FROM d_replies WHERE id_reply='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function add($question_id, $text, $author_id, $reply_id) {
        if (!$reply_id) $query = "INSERT INTO d_replies (`question_id`, `text`, `author_id`, `rating_l`, `rating_d`, `reply_id`) VALUES ('$question_id', '$text', '$author_id', 0, 0, null)";
        else $query = "INSERT INTO d_replies (`question_id`, `text`, `author_id`, `rating_l`, `rating_d`, `reply_id`) VALUES ('$question_id', '$text', '$author_id', 0, 0, $reply_id)";

        return $this->db->connection->query($query);
    }
}