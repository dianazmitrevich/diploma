<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';
use app\models\Project;

$result = [];
$sortType = $_POST['sort'];
$project = new Project();

if (isset($_POST['projects-list'])) {
    $projectsList = array_flip(explode(',', $_POST['projects-list']));
}

if ($projectsList) {
    foreach ($projectsList as $key => $value) {
        $projectsList[$key] = $project->getById('Projects', $key)['likes'];
    }
}

$sortType == 'asc' ? asort($projectsList) : arsort($projectsList);

if ($projectsList) {
    foreach ($projectsList as $key => $value) {
        $projectTemp = $project->getById('Projects', $key);
    
        $temp = [
            'alias' => $projectTemp['alias'],
            'likes' => $projectTemp['likes'],
            'name' => $projectTemp['name'],
            'imageSrc' => '/controllers/uploads/' . $project->getById('Medialibrary', $projectTemp['preview_id'])['imageSrc'],
            'service' => $project->getById('Services', $projectTemp['service_id'])['name'],
        ];
    
        $result[] = $temp;
    }
}

echo json_encode($result);