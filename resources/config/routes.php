<?php

return [
    '/' => [
        'controller' => 'MainController',
        'action' => 'render',
    ],
    '/login' => [
        'controller' => 'AuthController',
        'action' => 'login',
    ],
    '/logout' => [
        'controller' => 'AuthController',
        'action' => 'logout',
    ],
    '/register' => [
        'controller' => 'AuthController',
        'action' => 'register',
    ],
    '/profile' => [
        'controller' => 'ProfileController',
        'action' => 'render',
    ],
    '/edit-profile' => [
        'controller' => 'ProfileController',
        'action' => 'edit',
    ],
    '/edit-completed' => [
        'controller' => 'CompletedController',
        'action' => 'edit',
    ],
    '/remove-completed' => [
        'controller' => 'CompletedController',
        'action' => 'remove',
    ],
    '/topics' => [
        'controller' => 'TopicController',
        'action' => 'render',
    ],
    '/progress' => [
        'controller' => 'ProgressController',
        'action' => 'render',
    ],
    '/vacancies' => [
        'controller' => 'VacancyController',
        'action' => 'render',
    ],
    '/add-reply' => [
        'controller' => 'ReplyController',
        'action' => 'add',
    ],
    '/my-questions' => [
        'controller' => 'MyQuestionsController',
        'action' => 'render',
    ],
    '/add-question' => [
        'controller' => 'QuestionController',
        'action' => 'add',
    ],
    '/add-topic' => [
        'controller' => 'TopicController',
        'action' => 'add',
    ],
    '/like-reply' => [
        'controller' => 'ReplyController',
        'action' => 'like',
    ],
    '/dislike-reply' => [
        'controller' => 'ReplyController',
        'action' => 'dislike',
    ],
    '/api/main_topics' => [
        'controller' => 'APIController',
        'action' => 'getMainTopics',
    ],
    '/api/questions' => [
        'controller' => 'APIController',
        'action' => 'getQuestions',
    ],
    '/api/all-questions' => [
        'controller' => 'APIController',
        'action' => 'getAllQuestions',
    ],
    '/api/levels' => [
        'controller' => 'APIController',
        'action' => 'getLevels',
    ],
    '/api/topics' => [
        'controller' => 'APIController',
        'action' => 'getTopics',
    ],
    '/api/techs' => [
        'controller' => 'APIController',
        'action' => 'getTechs',
    ],
    // '/adm1n' => [
    //     'controller' => 'AdminController',
    //     'action' => 'render',
    // ],
    // '/snc' => [
    //     'controller' => 'AdminController',
    //     'action' => 'initialize',
    // ],
    // '/search' => [
    //     'controller' => 'SearchController',
    //     'action' => 'render',
    // ],
];