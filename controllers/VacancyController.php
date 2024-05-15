<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class VacancyController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function render()
    {
        require_once 'views/vacancies.php';
    }
}