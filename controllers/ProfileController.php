<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Company;
use app\models\Question;
use app\models\Topic;
use app\models\User;
use app\models\Vacancy;

class ProfileController extends Controller
{
    public $user;
    public $topic;
    public $question;
    public $company;
    public $vacancy;

    public function __construct()
    {
        $this->user = new User();
        $this->topic = new Topic();
        $this->question = new Question();
        $this->company = new Company();
        $this->vacancy = new Vacancy();
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
                $userEmail = $this->user->findByEmail($email);
                $email = $userEmail ? $userEmail['email'] : $email;
                $userLogin = $this->user->findByUsername($login);
                $login = $userLogin ? $userLogin['username'] : $login;

                $validated_errors = [];
                $validated_errors = $this->mainValidate(['inc' => $full_name]);
                if ($validated_errors) {
                    $error = $validated_errors;
                } else {
                    if (!$userEmail || ($userEmail && $email == $this->getUser()['email'])) {
                        if (!$userLogin || ($userLogin && $login == $this->getUser()['username'])) {
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
                        } else {
                            $error['inc'] = 'Выберите другой логин, такой уже используется.';
                        }
                    } else {
                        $error['inc'] = 'Данная почта уже используется.';
                    }
                }
            }

            if ($_POST['role'] == 'R') {
                $avatar = $_FILES['avatar'];
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $login = $this->getUser()['username'];

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

    public function validate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [];

            if ($this->getUser()['role'] == 'A') {
                $id_user = $_POST['id_user'];

                if ($id_user) {
                    if ($this->user->validate($id_user)) {
                        if ($this->editRecruiterLogin($id_user)) {
                            $error['ok'] = 1;
                        }
                    }
                }
            }
        }

        echo json_encode($error);
    }

    public function editRecruiterLogin($id_user) {
        $recruiter = $this->user->findById($id_user);
        $isValidated = $this->user->isValidated($id_user);

        if ($isValidated) {
            $full_name_translit = $this->translit($recruiter['full_name']);
            $name_translit = $this->translit($recruiter['name']);
            
            $full_name_parts = explode(' ', $full_name_translit);
            $first_name = $full_name_parts[0];
            $last_name = substr($full_name_parts[1], 0, 2);
            
            $company_name_parts = explode(' ', $name_translit);
            if (count($company_name_parts) > 2) {
                $name_translit = implode('_', $company_name_parts);
            }
            
            $login = mb_strtolower($first_name . '_' . $last_name . '@' . $name_translit);
        } else {
            $login = 'user' . rand(100000, 999999);
        }
        
        return $this->user->updateLogin($login, $id_user);
    }
    
    private function translit($text) {
        $translit_table = array(
            'А'=>'A','Б'=>'B','В'=>'V','Г'=>'G','Д'=>'D','Е'=>'E','Ё'=>'E',
            'Ж'=>'J','З'=>'Z','И'=>'I','Й'=>'Y','К'=>'K','Л'=>'L','М'=>'M',
            'Н'=>'N','О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U',
            'Ф'=>'F','Х'=>'H','Ц'=>'TS','Ч'=>'CH','Ш'=>'SH','Щ'=>'SCH','Ъ'=>'',
            'Ы'=>'YI','Ь'=>'','Э'=>'E','Ю'=>'YU','Я'=>'YA',
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e',
            'ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m',
            'н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u',
            'ф'=>'f','х'=>'h','ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'y',
            'ы'=>'yi','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya'
        );
        
        return strtr($text, $translit_table);
    }
}