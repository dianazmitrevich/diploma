<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';
use app\models\Project;

$result = [];
$keywords = explode(',', $_POST['keywords']);
$projectItem = new Project();

$projectsItems = $projectItem->db->readTable('Projects');

foreach ($keywords as $value) {
    foreach ($projectsItems as $p) {
        $regex = "/" . preg_quote(mb_strtolower($value, 'UTF-8'), '/') . "/";
        $desc = mb_strtolower($p['desc'], 'UTF-8');

        if (preg_match($regex, $desc)) {
            $temp = [
                'alias' => $p['alias'],
                'name' => $p['name'],
                'desc' => markKeywords($p['desc'], $keywords),
            ];
            $result[] = $temp;
        }
    }
}

function markKeywords($str, $keywords) {
    foreach ($keywords as $keyword) {
        $str = preg_replace("/($keyword)/iu", "<mark>$1</mark>", $str);
    }

    return $str;
}

echo json_encode($result);