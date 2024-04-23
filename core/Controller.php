<?php

namespace app\core;

use app\lib\Database;
use app\models\Topic;
use app\models\User;

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

    public function readAll() {
        return (new Topic())->readAll('d_topics');
    }
}