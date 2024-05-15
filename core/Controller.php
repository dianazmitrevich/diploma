<?php

namespace app\core;

use app\lib\Database;
use app\models\Topic;
use app\models\User;
use DateTime;
use IntlDateFormatter;

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

    // public function formatDate(string $timestamp): string {
    //     $date = new DateTime($timestamp);
    //     $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT, 'Europe/Moscow', IntlDateFormatter::GREGORIAN, 'd MMMM HH:mm');
    //     return $formatter->format($date);
    // }

    public function formatDate($timestamp){
        $date = new DateTime($timestamp);
        $now = new DateTime();
        $interval = $date->diff($now);
    
        if ($interval->y >= 1) {
            return $date->format('d m Y');
        } elseif ($interval->m >= 1) {
            return $interval->m . 'м';
        } elseif ($interval->d >= 7) {
            return floor($interval->d / 7) . 'нд';
        } elseif ($interval->d >= 1) {
            return $interval->d . 'дн';
        } elseif ($interval->h >= 1) {
            return $interval->h . 'ч';
        } elseif ($interval->i >= 1) {
            return $interval->i . 'мин';
        } else {
            return $interval->s . 'с';
        }
    }
}