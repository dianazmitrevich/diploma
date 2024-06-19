<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Completed;

class CompletedController extends Controller
{
    public $completed;

    public function __construct()
    {
        $this->completed = new Completed();
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            $question_id = $_POST['question_id'];
            $user_id = $_POST['user_id'];
            $isCompleted = $_POST['completed'];

            if ($isCompleted == 'Y') {
                $this->completed->add($question_id, $user_id);
                $error['ok'] = 1;
            } else {
                $this->completed->remove($question_id, $user_id);
                $error['ok'] = 1;
            }
        }

        $error['isCompleted'] = $isCompleted;

        echo json_encode($error);
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            $question_id = $_POST['question_id'];
            $user_id = $_POST['user_id'];

            $this->completed->remove($question_id, $user_id);
            $error['ok'] = 1;
        }

        echo json_encode($error);
    }
}