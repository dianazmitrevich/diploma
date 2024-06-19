<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Completed;
use app\models\Question;
use app\models\Topic;

class ProgressController extends Controller
{
    public $completed;
    public $question;
    public $topic;

    public function __construct()
    {
        $this->completed = new Completed();
        $this->question = new Question();
        $this->topic = new Topic();
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

    public function getValues() {
        $checked_topics = $_POST['checked'];
        $completed_count = $this->completed->getTopicCompleted($checked_topics, $this->getUser()['id_user'])['count'] ?? 0;
        $topic_count = $this->question->getByTopics($checked_topics)['count'] ?? 0;
        if ($topic_count != 0) {
            $percent = floor($completed_count * 100 / $topic_count);
        } else $percent = 0;

        echo json_encode(['completed_count' => $completed_count, 'topic_count' => $topic_count, 'percent' => $percent]);
    }
}