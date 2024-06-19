<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Company;
use app\models\Favourite;
use app\models\Level;
use app\models\Question;
use app\models\Technology;
use app\models\Topic;
use app\models\User;
use app\models\Vacancy;

class APIController extends Controller {
    private $user;
    private $topic;
    private $question;
    private $level;
    private $technology;
    private $company;
    private $vacancy;
    private $favourite;

    public function __construct() {
        $this->user = new User();
        $this->topic = new Topic();
        $this->question = new Question();
        $this->level = new Level();
        $this->technology = new Technology();
        $this->company = new Company();
        $this->vacancy = new Vacancy();
        $this->favourite = new Favourite();
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
            $questions[$key]['created_at'] = $this->formatDate($questions[$key]['created_at']);
            $questions[$key]['is_validated'] = $this->question->isValidated($row['question_id']);
            $questions[$key]['replies_count'] = count($this->question->getRepliesList($row['question_id']));
            foreach($this->favourite->getFavQuestions($row['question_id']) as $item) $questions[$key]['faved_by'][] = $item['user_id'];
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

    public function getTopicsCategorized() {
        $topics = $this->topic->readMainTopics();

        foreach ($topics as $key => $row) {
            $topics[$key]['subtopics'] = $this->topic->readSubTopics($row['id_topic']);
        }

        echo json_encode($topics);
    }

    public function getTechs() {
        echo json_encode($this->technology->getTechsList());
    }

    public function getCompanies() {
        echo json_encode($this->company->getAll());
    }

    public function getVacancies() {
        $vacancies = $this->vacancy->getAll();
        $vacanced_ids = [];
        
        foreach ($vacancies as $key => $row) {
            foreach ($this->vacancy->getResponses($row['id_vacancy']) as $key_inner => $value) {
                $vacanced_ids[] = $value['user_id'];
            }
            
            $vacancies[$key]['vacanced_ids'] = $vacanced_ids;
            $vacancies[$key]['responcesCount'] = count($this->vacancy->getResponses($row['id_vacancy']));
        }

        echo json_encode($vacancies);
    }

    public function getPositions() {
        echo json_encode($this->topic->readPositions());
    }

    public function getVacanced() {
        echo json_encode($this->vacancy->getAllResponses());
    }
}