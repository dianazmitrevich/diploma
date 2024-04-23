<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];
$budget = $_POST['budget'] ? $_POST['budget'] : 'не указан';
$phone = $_POST['phone'];
$social = $_POST['social'] ? $_POST['social'] : 'не указана';
$about = $_POST['about-project'] ? $_POST['about-project'] : 'не указано';

$mail = new PHPMailer;
$mail->setFrom('sncgroup@vh83.hoster.by');
$mail->addAddress('zmitrevichdiana@gmail.com');
$mail->Subject = 'Заявка с sncgroup.by';
$mail->msgHTML("<p><b>Имя</b>: $name</p>
<p><b>Компания</b>: $company</p>
<p><b>Почта</b>: $email</p>
<p><b>Бюджет</b>: $budget</p>
<p><b>Телефон</b>: $phone</p>
<p><b>Социальная сеть</b>: $social</p>
<p><b>О проекте</b>: $about</p>");

foreach(array_keys($_FILES['file']['name']) as $key) {
    $source = $_FILES['file']['tmp_name'][$key];
    $filename = $_FILES['file']['name'][$key];

    $mail->addAttachment($source, $filename);
}

$r = $mail->send();