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
    '/favourites' => [
        'controller' => 'FavouriteController',
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
    '/edit-favourite' => [
        'controller' => 'FavouriteController',
        'action' => 'editQuestion',
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
    '/remove-question' => [
        'controller' => 'QuestionController',
        'action' => 'remove',
    ],
    '/add-topic' => [
        'controller' => 'TopicController',
        'action' => 'add',
    ],
    '/remove-topic' => [
        'controller' => 'TopicController',
        'action' => 'remove',
    ],
    '/like-reply' => [
        'controller' => 'ReplyController',
        'action' => 'like',
    ],
    '/dislike-reply' => [
        'controller' => 'ReplyController',
        'action' => 'dislike',
    ],
    '/validate-topic' => [
        'controller' => 'TopicController',
        'action' => 'validate',
    ],
    '/validate-question' => [
        'controller' => 'QuestionController',
        'action' => 'validate',
    ],
    '/validate-recruiter' => [
        'controller' => 'ProfileController',
        'action' => 'validate',
    ],
    '/progress-topics' => [
        'controller' => 'ProgressController',
        'action' => 'getValues',
    ],
    '/vacancy-response' => [
        'controller' => 'VacancyController',
        'action' => 'makeResponse',
    ],
    '/remove-vacancy' => [
        'controller' => 'VacancyController',
        'action' => 'remove',
    ],
    '/add-vacancy' => [
        'controller' => 'VacancyController',
        'action' => 'add',
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
    '/api/topics-categorized' => [
        'controller' => 'APIController',
        'action' => 'getTopicsCategorized',
    ],
    '/api/techs' => [
        'controller' => 'APIController',
        'action' => 'getTechs',
    ],
    '/api/companies' => [
        'controller' => 'APIController',
        'action' => 'getCompanies',
    ],
    '/api/vacancies' => [
        'controller' => 'APIController',
        'action' => 'getVacancies',
    ],
    '/api/positions' => [
        'controller' => 'APIController',
        'action' => 'getPositions',
    ],
    '/api/vacanced' => [
        'controller' => 'APIController',
        'action' => 'getVacanced',
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