<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Company;
use app\models\User;

class AuthController extends Controller {
    public $user;
    public $company;

    public function __construct()
    {
        // session_start();
        $this->user = new User();
        $this->company = new Company();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->user->findByUsername($username);

            if ($user && $user['pass'] == $password) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['role'] = $user['role'];
                $error['ok'] = 1;
            } else {
                $error['inc_login'] = 'Неверное имя пользователя или пароль';
            }

            echo json_encode($error);
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['role']);
        header('Location: /');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($_POST['role'] == 'U') {
                $email = $_POST['email'];
                $full_name = $_POST['full_name'];
                $password = $_POST['pass'];
                $password_rep = $_POST['pass_rep'];

                $user = $this->user->findByEmail($email);
                if (!$user) {
                    if ($password == $password_rep) {
                        $this->user->add($_POST['role'], $email, $full_name, $password);
                        $user = $this->user->findByEmail($email);
                        $_SESSION['user_id'] = $user['id_user'];
                        $_SESSION['role'] = $user['role'];
                        $error['ok'] = 1;
                    } else {
                        $error['inc_pass_rep'] = 'Пароли не повторяются';
                    }
                } else {
                    $error['inc_email'] = 'Почта уже используется';
                }
            }

            if ($_POST['role'] == 'R') {
                $email = $_POST['email'];
                $full_name = $_POST['full_name'];
                $company_id = $_POST['company_id'];
                $document_url = $_FILES['document_url'];
                $password = $_POST['pass'];
                $password_rep = $_POST['pass_rep'];

                $user = $this->user->findByEmail($email);
                if (!$user) {
                    if ($company_id) {
                        if ($document_url) {
                            if ($password == $password_rep) {
                                $document_url = $this->uploadFile($document_url, 'recruiters');
                                if ($document_url) {
                                    $this->user->add(null, $email, $full_name, $password, $company_id, $document_url);
                                    $user = $this->user->findByEmail($email);
                                    $_SESSION['user_id'] = $user['id_user'];
                                    $_SESSION['role'] = $user['role'];
                                    $error['ok'] = 1;
                                } else {
                                    $error['inc_document'] = 'Ошибка при загрузке файла';
                                }
                            } else {
                                $error['inc_pass_rep'] = 'Пароли не повторяются';
                            }
                        } else {
                            $error['inc_document'] = 'Вы не прикрепили файл';
                        }
                    } else {
                        $error['inc_company'] = 'Вы не выбрали компанию';
                    }
                } else {
                    $error['inc_email'] = 'Почта уже используется';
                }                
            }

            echo json_encode($error);
        }
    }
}
?>
