<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Topic;

class SingleTopicController extends Controller
{
    public $topic;

    public function __construct()
    {
        $this->topic = new Topic();
    }

    public function render($nesting)
    {
        if (count($nesting) > 1) {
            if ($nesting[1]) {    
                require_once 'views/templates/topic.php';
            }
        }
    }
}