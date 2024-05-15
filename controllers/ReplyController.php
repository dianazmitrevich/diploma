<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Reply;

class ReplyController extends Controller
{
    public $user;
    public $reply;

    public function __construct()
    {
        $this->reply = new Reply();
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') {

                if (isset($_POST['reply_id'])) {
                    $reply_id = $_POST['reply_id'];
                } else {
                    $reply_id = null;
                }
                $question_id = $_POST['question_id'];
                $text = $_POST['text'];

                if ($text) {
                    $this->reply->add($question_id, $text, $this->getUser()['id_user'], $reply_id);
                    $error['ok'] = 1;
                } else {
                    $error['inc'] = 'Текст отзыва не может быть пустым.';
                }
            }
        }

        echo json_encode($error);
    }

    public function like() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];
    
            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') {
    
                $reply_id = $_POST['question_id'];
                $user_id = $_POST['user_id'];
                $action = 'L';

                if ($this->reply->rate($reply_id, $user_id, $action)) {
                    $error['ok'] = 1;
                    $error['new_rating_l'] = $this->reply->getRating($reply_id)['new_rating_l'];
                    $error['new_rating_d'] = $this->reply->getRating($reply_id)['new_rating_d'];
                }
            }
        }
    
        echo json_encode($error);
    }
    
    public function dislike() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];
    
            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') {
    
                $reply_id = $_POST['question_id'];
                $user_id = $_POST['user_id'];
                $action = 'D';
    
                if ($this->reply->rate($reply_id, $user_id, $action)) {
                    $error['ok'] = 1;
                    $error['new_rating_l'] = $this->reply->getRating($reply_id)['new_rating_l'];
                    $error['new_rating_d'] = $this->reply->getRating($reply_id)['new_rating_d'];
                }
            }
        }
    
        echo json_encode($error);
    }
}