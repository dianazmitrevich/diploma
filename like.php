<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';
use app\models\Project;

$user_ip = $_SERVER['REMOTE_ADDR'];
$project_id = $_POST['projectId'];

$ipStr = str_ireplace('.', '_', $user_ip);
$cookie_name = 'liked_project_' . $project_id . '_' . $ipStr;

$project = new Project();

if (!isset($_COOKIE[$cookie_name])) {
    $project->editLikes($project_id, 1);
    setcookie('liked_project_' . $project_id . '_' . $user_ip, true, time() + 3600 * 24 * 365);
} else {
    $project->editLikes($project_id, 0);
    setcookie('liked_project_' . $project_id . '_' . $user_ip, '', time() - 3600);
}

$likes_count = $project->getById('Projects', $project_id)['likes'];
echo $likes_count;