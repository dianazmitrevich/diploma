<?php

$selector = $_POST['id'];
$api = $_POST['api'];

$checked_mutiple = json_decode($_POST['checked_inputs'], true);
$checks = [];
foreach ($checked_mutiple as $key => $value) {
    $checks[$key] = explode(',', trim($value, ','));
}
$html = '';
$data = json_decode(file_get_contents($_SERVER['HTTP_ORIGIN'] . '/api/' . $api, FILE_USE_INCLUDE_PATH));

if ($_POST['element_id']) {
    $file_path = '../views/components/' . $_POST['element_id'] . '.php';
    $html = renderTemplate($file_path, $data, $checks);
}

function renderTemplate($templatePath, $data, $checks) {
    $data = $data;
    $checks = $checks;

    ob_start();

    require($templatePath);

    return ob_get_clean();
}

echo json_encode(['selector' => $selector, 'html' => $html]);