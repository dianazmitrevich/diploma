<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Company;
use app\models\Topic;
use app\models\User;
use app\models\Vacancy;

class VacancyController extends Controller
{
    public $user;
    public $topic;
    public $company;
    public $vacancy;

    public function __construct()
    {
        $this->user = new User();
        $this->topic = new Topic();
        $this->company = new Company();
        $this->vacancy = new Vacancy();
    }

    public function render()
    {
        require_once 'views/vacancies.php';
    }

    public function makeResponse() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];
    
            if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') {
                $user_id = $_POST['user_id'];
                $vacancy_id = $_POST['vacancy_id'];

                if ($this->vacancy->makeResponse($user_id, $vacancy_id)) {
                    $error['ok'] = 1;
                }
            }
        }
    
        echo json_encode($error);
    }

    public function remove() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];
    
            if ($this->getUser()['role'] == 'R') {
                $vacancy_id = $_POST['vacancy_id'];

                if ($this->vacancy->remove($vacancy_id)) {
                    $error['ok'] = 1;
                }
            }
        }
    
        echo json_encode($error);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];
    
            if ($this->getUser()['role'] == 'R') {
                $position = $_POST['position'];
                $level = $_POST['level'];
                $description = $_POST['description'];

                $validated_errors = [];
                $validated_errors = $this->mainValidate(['inc_desc' => $description]);
                if ($validated_errors) {
                    $error = $validated_errors;
                } else {
                    if ($position) {
                        if ($level) {
                            if ($this->vacancy->add($position, $level, $description, $this->getUser()['id_user'])) {
                                $error['ok'] = 1;
                            }
                        } else {
                            $error['inc_level'] = 'Вы не выбрали уровень.';
                        }
                    } else {
                        $error['inc_position'] = 'Вы не выбрали позицию.';
                    }
                }
            }
        }
    
        echo json_encode($error);
    }
}