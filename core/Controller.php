<?php

namespace app\core;

use app\models\User;
use DateTime;
use DateTimeZone;
use Wkhooy\ObsceneCensorRus;

abstract class Controller
{
    public function getAuth() {
        return $_SESSION['user_id'] ?? '';
    }

    public function getUser() {
        return (new User())->findById($this->getAuth());
    }

    public function uploadFile($file, $sub) {
        if(isset($file['name']) && $file['error'] == 0) {
            $uploadDir = '/uploads/' . $sub . '/';
            $prefix = __DIR__ . '/..';
            
            if (!file_exists($prefix . $uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $uniqueName = uniqid() . '-' . basename($file['name']);
            $filePath = $prefix . $uploadDir . $uniqueName;
    
            if(move_uploaded_file($file['tmp_name'], $filePath)) {
                return $uniqueName;
            } else {
                return 'Ошибка при загрузке файла.';
            }
        } else {
            return 'Файл не был загружен.';
        }
    }

    public function formatDate($timestamp){
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $timestamp, new DateTimeZone('Europe/Minsk'));
        if (!$date) {
            return 'Неверный timestamp';
        }
    
        $now = new DateTime('now', new DateTimeZone('Europe/Minsk'));
        $interval = $now->diff($date);
    
        if ($interval->y >= 1) {
            return $interval->y . ' год(а) назад';
        } elseif ($interval->m >= 1) {
            return $interval->m . ' месяц(а) назад';
        } elseif ($interval->d >= 7) {
            return floor($interval->d / 7) . ' неделю(и) назад';
        } elseif ($interval->d >= 1) {
            return $interval->d . ' день(дней) назад';
        } elseif ($interval->h >= 1) {
            return $interval->h . ' час(ов) назад';
        } elseif ($interval->i >= 1) {
            return $interval->i . ' минут(ы) назад';
        } else {
            return $interval->s . ' секунд(ы) назад';
        }
    }

    public function mainValidate($params) {
        $errors = [];
        foreach ($params as $paramName => $paramValue) {
            if (!ObsceneCensorRus::isAllowed($paramValue)) {
                $errors[$paramName] = 'Надо написать что-то без использования нецензурщины.';
            }
        }
        return $errors;
    }
}
