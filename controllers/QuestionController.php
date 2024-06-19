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

            if (!$this->getUser()['role'] && $this->getUser()['document_url']) {
                $error['inc_operation'] = 'Чтобы добавлять вопросы в роли рекрутера, ваш статус рекрутера должен быть подтвержден администратором сайта (отслеживать статус можно в личном кабинете).';
            }
            
            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S' || $this->getUser()['role'] == 'R') {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $author_id = $_POST['author_id'];
                $level = $_POST['level'];
                $topic = $_POST['topic'];
                // $techs = explode(',', trim($_POST['techs'], ','));
                $techs = explode(',', trim($_POST['techs_list'], ','));
                $alias = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);

                $validated_errors = [];
                $validated_errors = $this->mainValidate(['inc_name' => $name, 'inc_desc' => $description]);
                if ($validated_errors) {
                    $error = $validated_errors;
                } else {
                    if ($level) {
                        if ($topic) {
                            if ($techs[0]) {
                                $this->question->add($name, $description, $level, $topic, $author_id, $alias);

                                $id = $this->question->findByAlias($alias)['id_question'];
                                $numbers = [];
                                $strings = [];

                                foreach ($techs as $key => $value) {
                                    if (is_numeric($value)) {
                                        $numbers[$key] = $value;
                                    } else {
                                        $strings[$key] = $value;
                                    }
                                }

                                $numbers = $strings ? array_merge($numbers, $this->technology->add($strings)) : $numbers;
                                // var_dump(['techs' => $techs, 'merged' => $numbers, 'numbers' => array_filter($techs, 'is_numeric'), 'strings' => $strings]);

                                if ($this->technology->addBulk($numbers, $id)) {
                                    $error['ok'] = 1;
                                }
                            } else {
                                $error['inc_techs'] = 'Надо выбрать или добавить хотя бы одну';
                            }
                        } else {
                            $error['inc_topic'] = 'Вы не выбрали тему';
                        }
                    } else {
                        $error['inc_level'] = 'Вы не выбрали уровень';
                    }
                }
            }
        }

        echo json_encode($error);
    }

    public function remove() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            $question_id = $_POST['question_id'];

            $this->question->remove($question_id);
            $error['ok'] = 1;
        }

        echo json_encode($error);
    }

    public function validate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($this->getUser()['role'] == 'A') {
                $question_id = $_POST['question_id'];

                if ($question_id) {
                    $this->question->validate($question_id);
                    $error['ok'] = 1;
                }
            }
        }

        echo json_encode($error);
    }
}