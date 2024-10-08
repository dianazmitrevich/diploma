<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Question;
use app\models\Topic;
use app\models\User;

class MyQuestionsController extends Controller
{
    private $user;
    private $question;
    private $topic;

    public function __construct()
    {
        $this->user = $this->getUser();
        $this->question = new Question();
        $this->topic = new Topic();
    }

    public function render()
    {
        require_once 'views/my-questions.php';
    }

    public function getMyQuestions() {
        $my_questions = $this->question->findByAuthor($this->getUser()['id_user']);

        foreach ($my_questions as $key => $row) {
            $my_questions[$key]['tags'] = $this->question->getTechnologiesList($row['id_question']);
        }

        return $my_questions;
    }

    public function getMyTopics() {
        return $this->topic->findByAuthor($this->getUser()['id_user']);
    }

    public function getQuestionsCount($value) {
        return $this->topic->getQuestionsCount($value);
    }
}