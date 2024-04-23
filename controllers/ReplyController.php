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
        $this->user = new Reply();
    }

    public function render()
    {
        require_once 'views/profile.php';
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($_POST['role'] == 'U') {
                $avatar = $_FILES['avatar'];
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $login = $_POST['login'];

                if ($this->getUser()) {
                    if ($avatar['name']) {
                        $avatar = $this->uploadFile($avatar, 'img');
                        if ($avatar) {
                            $this->user->edit($avatar, $full_name, $email, $login, $this->getUser()['id_user']);
                            $error['ok'] = 1;
                        } else {
                            $error['inc'] = 'Ошибка при загрузке файла';
                        }
                    } else {
                        $this->user->edit($this->getUser()['avatar'], $full_name, $email, $login, $this->getUser()['id_user']);
                        $error['ok'] = 1;
                    }
                } else {
                    $error['inc'] = 'что-то не то';
                }
            }
        }

        echo json_encode($error);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') {

                $question_id = $_POST['question_id'];
                $text = $_POST['text'];

                if ($text) {
                    $this->reply->add($question_id, $text, $this->getUser()['id_user']);
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

                $this->reply->likeRating($reply_id, $user_id);
                $error['ok'] = 1;
                $error['new_rating'] = $this->reply->getRating($reply_id);
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

                $this->reply->dislikeRating($reply_id, $user_id);
                $error['ok'] = 1;
                $error['new_rating'] = $this->reply->getRating($reply_id);
            }
        }

        echo json_encode($error);
    }
}