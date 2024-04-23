<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';
use app\models\Project;

$types = $_POST['type'] ?? [];
$services = $_POST['service'] ?? [];
$filter_result = [];
$result = [];
$found_projects_types = [];
$found_projects_services = [];

$project = new Project();

if ($types) {
    foreach ($types as $type) {
        foreach ($project->readAllWhere('Projects', 'type_id', $type) as $value) {
            $found_projects_types[] = $value['id'];
        }
    }
}

if ($services) {
    foreach ($services as $service) {
        foreach ($project->readAllWhere('Projects', 'service_id', $service) as $value) {
            $found_projects_services[] = $value['id'];
        }
    }
}

if (!$types && !$services) {
    foreach ($project->db->readTable('Projects') as $value) {
        $filter_result[] = $value['id'];
    }
}

if ($found_projects_types && $found_projects_services) {
    foreach ($found_projects_types as $value) {
        if (in_array($value, $found_projects_services)) {
            $filter_result[] = $value;
        }
    }
} elseif ($found_projects_types && !$found_projects_services) {
    $filter_result = $found_projects_types;
} elseif (!$found_projects_types && $found_projects_services) {
    $filter_result = $found_projects_services;
}

if ($filter_result) {
    foreach ($filter_result as $item) {
        $projectTemp = $project->getById('Projects', $item);
    
        $temp = [
            'alias' => $projectTemp['alias'],
            'likes' => $projectTemp['likes'],
            'name' => $projectTemp['name'],
            'imageSrc' => '/controllers/uploads/' . $project->getById('Medialibrary', $projectTemp['preview_id'])['imageSrc'],
            'service' => $project->getById('Services', $projectTemp['service_id'])['name'],
        ];
    
        $projectsArr[] = $temp;
        $projectsIdsArr[] = $projectTemp['id'];
    }
}

$result[] = $projectsArr;
$result[] = $projectsIdsArr;

echo json_encode($result);