<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Favourite;
use app\models\Question;
use app\models\User;

class FavouriteController extends Controller
{
    public $favourite;
    public $question;
    public $user;

    public function __construct()
    {
        $this->favourite = new Favourite();
        $this->question = new Question();
        $this->user = new User();
    }

    public function render()
    {
        require_once 'views/favourites.php';
    }

    public function editQuestion()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            $question_id = $_POST['question_id'];
            $user_id = $_POST['user_id'];
            $isCompleted = $_POST['completed'];

            if ($isCompleted == 'Y') {
                $this->favourite->add($question_id, $user_id);
                $error['ok'] = 1;
            } else {
                $this->favourite->remove($question_id, $user_id);
                $error['ok'] = 1;
            }
        }

        $error['isCompleted'] = $isCompleted;

        echo json_encode($error);
    }

    public function getFavedQuestions() {
        $my_questions = $this->favourite->getFavQuestions($this->getUser()['id_user']);

        foreach ($my_questions as $key => $row) {
            $my_questions[$key]['tags'] = $this->question->getTechnologiesList($row['id_question']);
        }

        return $my_questions;
    }
}