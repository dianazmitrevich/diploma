<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Level;
use app\models\Question;
use app\models\Technology;
use app\models\Topic;
use app\models\User;

class APIController extends Controller {
    private $user;
    private $topic;
    private $question;
    private $level;
    private $technology;

    public function __construct() {
        $this->user = new User();
        $this->topic = new Topic();
        $this->question = new Question();
        $this->level = new Level();
        $this->technology = new Technology();
    }

    public function getMainTopics() {
        $main_topics = $this->topic->readMainTopics();

        foreach ($main_topics as $key => $row) {
            $main_topics[$key]['subtopics'] = $this->topic->readSubTopics($row['id_topic']);
        }

        echo json_encode($main_topics);
    }

    public function getQuestions() {
        $questions = $this->question->getFilteredQuestions();

        foreach ($questions as $key => $row) {
            $questions[$key]['tags'] = $this->question->getTechnologiesList($row['question_id']);
        }

        echo json_encode($questions);
    }

    public function getAllQuestions() {
        $questions = $this->question->getQuestions();

        foreach ($questions as $key => $row) {
            $questions[$key]['tags'] = $this->question->getTechnologiesList($row['question_id']);
        }

        echo json_encode($questions);
    }

    public function getLevels() {
        echo json_encode($this->level->getLevelsList());
    }

    public function getTopics() {
        $topics = $this->topic->readAllSubTopics();

        foreach ($topics as $key => $row) {
            $topics[$key]['main_topic_name'] = $this->topic->readMainTopic($row['topic_id'])['name'];
        }

        echo json_encode($topics);
    }

    public function getTechs() {
        echo json_encode($this->technology->getTechsList());
    }
}