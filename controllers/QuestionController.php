<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Question;
use app\models\Technology;

class QuestionController extends Controller
{
    public $question;
    public $technology;

    public function __construct()
    {
        $this->question = new Question();
        $this->technology = new Technology();
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') {

                $name = $_POST['name'];
                $description = $_POST['description'];
                $author_id = $_POST['author_id'];
                $level = $_POST['level'];
                $topic = $_POST['topic'];
                $techs = explode(',', trim($_POST['techs'], ','));
                $alias = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);

                if ($level) {
                    if ($topic) {
                        if ($techs) {
                            $this->question->add($name, $description, $level, $topic, $author_id, $alias);

                            $id = $this->question->findByAlias($alias)['id_question'];
                            $this->technology->addBulk($techs, $id);

                            $error['ok'] = 1;
                        } else {
                            $error['inc_techs'] = 'Надо выбрать хотя бы одну';
                        }
                    } else {
                        $error['inc_topic'] = 'Вы не выбрали тему';
                    }
                } else {
                    $error['inc_level'] = 'Вы не выбрали уровень';
                }
            }
        }

        echo json_encode($error);
    }
}