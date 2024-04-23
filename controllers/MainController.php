<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Question;
use app\models\Topic;

class MainController extends Controller
{
    private $topic;
    private $question;

    public function __construct()
    {
        session_start();
        $this->topic = new Topic();
        $this->question = new Question();
    }

    public function render()
    {
        require_once 'views/index.php';
    }

    public function getMainTopics() {
        return $this->topic->readMainTopics();
    }

    public function getQuestions() {
        return $data = json_decode(file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/api/all-questions', FILE_USE_INCLUDE_PATH));
    }
}