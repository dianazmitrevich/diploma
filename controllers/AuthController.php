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
        $this->user = new User();
        $this->company = new Company();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $user = $this->user->findByUsername($username);
            if (!$user) {
                $user = $this->user->findByEmail($username);
            }

            if ($user && $user['pass'] == $password) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['role'] = $user['role'];
                $error['ok'] = 1;
                $error['redirect_url'] = '/profile';
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

                $validated_errors = [];
                $validated_errors = $this->mainValidate(['inc_full_name' => $full_name]);
                if ($validated_errors) {
                    $error = $validated_errors;
                } else {
                    $user = $this->user->findByEmail($email);
                    if (!$user) {
                        if ($password == $password_rep) {
                            $this->user->add($_POST['role'], $email, $full_name, md5($password));
                            $user = $this->user->findByEmail($email);
                            $_SESSION['user_id'] = $user['id_user'];
                            $_SESSION['role'] = $user['role'];
                            $error['ok'] = 1;
                            $error['redirect_url'] = '/profile';
                        } else {
                            $error['inc_pass_rep'] = 'Пароли не повторяются';
                        }
                    } else {
                        $error['inc_email'] = 'Почта уже используется';
                    }
                }
            }

            if ($_POST['role'] == 'R') {
                $email = $_POST['email'];
                $full_name = $_POST['full_name'];
                $company_id = $_POST['company_id'];
                $company_name = $_POST['company'];
                $document_url = $_FILES['document_url'];
                $password = $_POST['pass'];
                $password_rep = $_POST['pass_rep'];

                $validated_errors = [];
                $validated_errors = $this->mainValidate(['inc_full_name' => $full_name]);
                if ($validated_errors) {
                    $error = $validated_errors;
                } else {
                    $user = $this->user->findByEmail($email);
                    if (!$user) {
                        if ($company_id || $company_name) {
                            if ($document_url['tmp_name']) {
                                if ($password == $password_rep) {
                                    $document_url = $this->uploadFile($document_url, 'recruiters');
                                    if ($document_url) {
                                        if (!$company_id) {
                                            $this->company->add($company_name);
                                            $company = $this->company->findByName($company_name);
                                            $company_id = $company['id_company'];
                                        }

                                        $this->user->add(null, $email, $full_name, md5($password), $company_id, $document_url);
                                        $user = $this->user->findByEmail($email);
                                        $_SESSION['user_id'] = $user['id_user'];
                                        $_SESSION['role'] = $user['role'];
                                        $error['ok'] = 1;
                                        $error['redirect_url'] = '/profile';
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
            }

            echo json_encode($error);
        }
    }
}
?>