<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Level;
use app\models\Question;
use app\models\Reply;
use app\models\Technology;
use app\models\Topic;
use app\models\User;

class TopicController extends Controller
{
    public $topic;
    public $user;
    public $question;
    public $technology;
    public $level;
    public $reply;

    public function __construct()
    {
        $this->topic = new Topic();
        $this->user = new User();
        $this->question = new Question();
        $this->technology = new Technology();
        $this->level = new Level();
        $this->reply = new Reply();
    }

    public function render($nesting)
    {
        if (count($nesting) == 2) {
            if ($nesting[1]) {
                $main_topic = $_GET['main_topic'];
                $topic = $this->topic->getTopictByAlias($nesting[1], $main_topic);
                $this->topic->setAlias($nesting[1]);
                $this->topic->setId($topic['id_topic']);
                $this->topic->setMainTopicId($topic['topic_id']);
                $this->topic->setName($topic['name']);
                $this->topic->setQuestions($this->topic->findAllQuestions());
                $this->topic->setTechs($this->topic->findAllTechs());
                $this->topic->setLevels($this->topic->findAllLevels());
                require_once 'views/templates/topic.php';
            }
        }
        else if (count($nesting) == 3) {
            $question = $this->question->getQuestiontByAlias($nesting[2]);
            $this->question->setAlias($nesting[2]);
            $this->question->setId($question['id_question']);
            $this->question->setTopic($question['subtopic_id']);
            $this->question->setLevel($question['level_id']);
            $this->question->setTechs($this->question->getTechnologiesList());
            $this->question->setReplies($this->question->getRepliesList());
            $this->question->setCompleted($this->question->isCompleted());

            require_once 'views/templates/question.php';
        }
        else {
            require_once 'views/topics.php';
        }
    }

    public function getTopicsIds()
    {
        $arr = [];
        $temp = $this->topic->readMainTopics();

        foreach ($temp as $key => $row) {
            $arr[] = $row['id_topic'];
        }
        
        echo implode(',', $arr);
    }

    public function getLevelsIds()
    {
        $arr = [];
        $temp = $this->topic->getLevels();

        foreach ($temp as $key => $row) {
            $arr[] = $row['id_level'];
        }
        
        echo implode(',', $arr);
    }

    public function getTechIds()
    {
        $arr = [];
        $temp = $this->topic->getTechs();

        foreach ($temp as $key => $row) {
            $arr[] = $row['id_tech'];
        }
        
        echo implode(',', $arr);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') {

                $name = $_POST['name'];
                $main_topic = $_POST['main_topic'];
                $author_id = $_POST['author_id'];

                if ($main_topic) {
                    $this->topic->add($name, $main_topic, $author_id);
                    $error['ok'] = 1;
                } else {
                    $error['inc_topic'] = 'Вы не выбрали тему';
                }
            }
        }

        echo json_encode($error);
    }
}