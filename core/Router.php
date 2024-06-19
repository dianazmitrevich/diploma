<?php

namespace app\core;

use app\controllers\APIController;
use app\controllers\MainController;
use app\controllers\AuthController;
use app\controllers\CompletedController;
use app\controllers\FavouriteController;
use app\controllers\MyQuestionsController;
use app\controllers\ProfileController;
use app\controllers\ProgressController;
use app\controllers\QuestionController;
use app\controllers\ReplyController;
use app\controllers\TopicController;
use app\controllers\VacancyController;

class Router
{
    private string $url;
    private array $routes;
    private array $params;
    private array $nesting;
    private array $controllers;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->routes = include_once 'resources/config/routes.php';
        $this->params = $this->listParameters($_SERVER['QUERY_STRING']);
        $this->nesting = $this->listNesting($this->url);
        $this->controllers = [
            'MainController' => (new MainController),
            'AuthController' => (new AuthController),
            'APIController' => (new APIController),
            'TopicController' => (new TopicController),
            'ReplyController' => (new ReplyController),
            'MyQuestionsController' => (new MyQuestionsController),
            'QuestionController' => (new QuestionController),
            'ProfileController' => (new ProfileController),
            'ProgressController' => (new ProgressController),
            'VacancyController' => (new VacancyController),
            'CompletedController' => (new CompletedController),
            'FavouriteController' => (new FavouriteController)
        ];
    }

    public function run()
    {
        $uri = parse_url($this->url);

        $path = strpos($uri['path'], '/', 1) > 0 ? substr($uri['path'], 0, strpos($uri['path'], '/', 1)) : $uri['path'];

        if (substr($uri['path'], 0, strpos($uri['path'], '/', 1)) == '/api') {
            $path = $uri['path'];
        }

        if (array_key_exists($path, $this->routes) === false) {
            header('HTTP/1.0 404 Not Found');
            echo '404';
            exit();
        }

        $action = $this->routes[$path]['action'];
        // echo '<pre>';
        // print_r(count($this->nesting));
        // echo'</pre>';

        call_user_func([$this->controllers[$this->routes[$path]['controller']], $action], $this->nesting);
    }

    public function listParameters(string $params)
    {
        if ($params) {
            $tempArr = explode('&', $params);

            foreach ($tempArr as $item) {
                $pos = strpos($item, '=');
                $list[substr($item, 0, $pos)] = substr($item, $pos + 1, strlen($item));
            }
        }

        return $list ?? [];
    }

    public function listNesting(string $params)
    {
        $arr = explode('/', $params);
        array_shift($arr);
    
        foreach ($arr as $key => $value) {
            $pos = strpos($value, '?');
            if ($pos !== false) {
                $arr[$key] = substr($value, 0, $pos);
            }
        }
    
        return $arr ?? [];
    }
    
}