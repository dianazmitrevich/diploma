<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Completed;
use app\models\Question;

class ProgressController extends Controller
{
    public $completed;
    public $question;

    public function __construct()
    {
        $this->completed = new Completed();
        $this->question = new Question();
    }

    public function render()
    {
        require_once 'views/progress.php';
    }

    public function getCompleted() {
        $completed = $this->completed->getCompleted($this->getUser()['id_user']);

        foreach ($completed as $key => $row) {
            $completed[$key]['tags'] = $this->question->getTechnologiesList($row['question_id']);
        }

        return $completed;
    }
}