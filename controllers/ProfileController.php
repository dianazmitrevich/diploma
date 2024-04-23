<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class ProfileController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function render()
    {
        require_once 'views/profile.php';
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($_POST['role'] == 'U') {
                $avatar = $_FILES['avatar'];
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $login = $_POST['login'];

                if ($this->getUser()) {
                    if ($avatar['name']) {
                        $avatar = $this->uploadFile($avatar, 'img');
                        if ($avatar) {
                            $this->user->edit($avatar, $full_name, $email, $login, $this->getUser()['id_user']);
                            $error['ok'] = 1;
                        } else {
                            $error['inc'] = 'Ошибка при загрузке файла';
                        }
                    } else {
                        $this->user->edit($this->getUser()['avatar'], $full_name, $email, $login, $this->getUser()['id_user']);
                        $error['ok'] = 1;
                    }
                } else {
                    $error['inc'] = 'что-то не то';
                }
            }
        }

        echo json_encode($error);
    }
}