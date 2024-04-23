<?php

$selector = 'popups';
$html = '';
$api = [];
$data = [];

if ($_POST['api'] && $_POST['element_id'] && $_POST['user']) {
    $api = explode('/', $_POST['api']);
    $user = $_POST['user'];

    foreach ($api as $key => $value) {
        $data[$key] = json_decode(file_get_contents($_SERVER['HTTP_ORIGIN'] . '/api/' . $value, FILE_USE_INCLUDE_PATH));
    }

    $file_path = '../views/components/' . $_POST['element_id'] . '.php';
    $html .= renderTemplate($file_path, $data, $user);
} else {
    if ($_POST['element_id']) {
        $file_path = '../views/components/' . $_POST['element_id'] . '.php';
        $html = file_get_contents($file_path, FILE_USE_INCLUDE_PATH);
    }
}

// if ($_POST['element_id']) {
//     $file_path = '../views/components/' . $_POST['element_id'] . '.php';
//     $html = file_get_contents($file_path, FILE_USE_INCLUDE_PATH);
// }

function renderTemplate($templatePath, $data, $user) {
    $data = $data;
    $user = $user;

    ob_start();

    require($templatePath);

    return ob_get_clean();
}

echo json_encode(['selector' => $selector, 'html' => $html]);