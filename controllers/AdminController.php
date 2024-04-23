<?php

namespace app\controllers;

use app\models\Project;
use app\models\Service;
use app\models\ProjectType;
use app\models\TeamMember;
use app\models\Technology;
use app\models\Medialibrary;
use app\models\Moderator;

class AdminController
{
    private $project;
    private $service;
    private $projectType;
    private $teamMember;
    private $technology;
    private $medialibrary;
    private $moderator;

    public function __construct()
    {
        $this->project = new Project();
        $this->service = new Service();
        $this->projectType = new ProjectType();
        $this->teamMember = new TeamMember();
        $this->technology = new Technology();
        $this->medialibrary = new Medialibrary();
        $this->moderator = new Moderator();
    }

    public function initialize($params) {
        session_start();
        unset($_SESSION['isAdmin']);
        
        if (isset($_POST['signup-page'])) {
            require_once 'views/admin/signup.php';
            exit();
        } else if (isset($_POST['login-page'])) {
            require_once 'views/admin/login.php';
            exit();
        } 
        else if (isset($_POST['login-btn'])) {
            $moderator = $this->moderator->checkModerator($_POST);
            
            if ($moderator) {
                $_SESSION['isAdmin'] = $moderator['isAdmin'];

                header('Location: /adm1n');
                exit();
            }

            $err = "Check your password or login accuracy";
            require_once 'views/admin/login.php';
            exit();
        } else if (isset($_POST['signup-btn'])) {
            $moderator = $this->moderator->getByParameter('inviteKey', $_POST['code']);
            
            if ($moderator) {
                if ($moderator['login'] == null) {
                    if (!($this->moderator->getByParameter('login', $_POST['login']))) {
                        if ($_POST['password'] == $_POST['passwordRep']) {
                            $this->moderator->edit($moderator['id'], $_POST);
                    
                            require_once 'views/admin/login.php';
                            exit();
                        }

                        $err = "Passwords should match";
                        require_once 'views/admin/signup.php';
                        exit();
                    }
    
                    $err = "Choose another login";
                    require_once 'views/admin/signup.php';
                    exit();
                }
            }

            $err = "Your invitation code is incorrect";
            require_once 'views/admin/signup.php';
            exit();
        }

        require_once 'views/admin/login.php';
    }

    public function render($params)
    {
        session_start();

        if (isset($_SESSION['isAdmin'])) {
            if (count($params) > 1) {
                if (isset($_POST['back'])) {
                    header('Location: /adm1n'); exit();
                }
                else if (strpos($params[1], 'profile') === 0 && $_SESSION['isAdmin'] == 1) {
                    require_once 'views/admin/profile.php'; exit();
                }
                else if (strpos($params[1], 'delete') === 0) {
                    if ($_POST['table'] == 'Medialibrary') {
                        foreach ($_POST['images'] as $value) {
                            $this->deleteItem($_POST['table'], $value);
                        }
    
                        header('Location: /adm1n'); exit();
                    }
                    $this->deleteItem($_POST['table'], $_POST['id']);
                    header('Location: /adm1n');
                }
                else if (strpos($params[1], 'edit') === 0) {
                    if (isset($_POST['edit-btn'])) {
                        $this->editItem($_POST['table'], $_POST['itemId']);
                        header('Location: /adm1n'); exit();
                    } else {
                        if ($_POST['table'] == 'Projects') {
                            $temp = $this->project->getById('Projects', $_POST['id']);
                        
                            $this->project->setId($temp['id']);
                            $this->project->setName($temp['name']);
                            $this->project->setDesc($temp['desc']);
                            $this->project->setDeadline($temp['deadline']);
                            $this->project->setDevPeriod($temp['periodOfDev']);
                            $this->project->setServiceId($temp['service_id']);
                            $this->project->setTypeId($temp['type_id']);
                            $this->project->setLikes($temp['likes']);
                            $this->project->setAlias($temp['alias']);
                            $this->project->setTextHtml($temp['textHtml']);
                            $this->project->setPreviewId($temp['preview_id']);
                        }
    
                        if ($_POST['table'] == 'Services') {
                            $temp = $this->service->getById('Services', $_POST['id']);
                        
                            $this->service->setId($temp['id']);
                            $this->service->setName($temp['name']);
                        }
    
                        if ($_POST['table'] == 'ProjectTypes') {
                            $temp = $this->projectType->getById('ProjectTypes', $_POST['id']);
                        
                            $this->projectType->setId($temp['id']);
                            $this->projectType->setName($temp['name']);
                        }
    
                        if ($_POST['table'] == 'Team') {
                            $temp = $this->teamMember->getById('Team', $_POST['id']);
                        
                            $this->teamMember->setId($temp['id']);
                            $this->teamMember->setName($temp['name']);
                            $this->teamMember->setPosition($temp['position']);
                            $this->teamMember->setImageId($temp['image_id']);
                        }
    
                        if ($_POST['table'] == 'TechnologiesList') {
                            $temp = $this->technology->getById('TechnologiesList', $_POST['id']);
                        
                            $this->technology->setId($temp['id']);
                            $this->technology->setImageId($temp['image_id']);
                        }
                        
                        require_once 'views/admin/edit.php'; exit();
                    }
                }
                else if (strpos($params[1], 'add') === 0) {
                    if (isset($_POST['add-btn'])) {
                        $this->addItem($_POST['table']);
                        header('Location: /adm1n'); exit();
                    } else if (isset($_POST['files-add-btn'])) {
                        $this->loadFiles();
                        header('Location: /adm1n'); exit();
                    } else if (isset($_POST['add-key'])) {
                        $this->addItem($_POST['table']);
                        require_once 'views/admin/profile.php'; exit();
                    } else {
                        require_once 'views/admin/add.php'; exit();
                    }
                }

                header('Location: /adm1n'); exit();
            }
    
            require_once 'views/admin/admin.php';
        } else {
            header('Location: /snc');
            exit();
        }
    }

    public function readTable(string $table)
    {
        return $this->service->db->readTable($table);
    }

    public function deleteItem(string $table, int $id) {
        if ($table == 'Projects') {
            $this->project->delete($id);
        }

        if ($table == 'Services') {
            $this->service->delete($id);
        }

        if ($table == 'ProjectTypes') {
            $this->projectType->delete($id);
        }

        if ($table == 'Team') {
            $this->teamMember->delete($id);
        }

        if ($table == 'TechnologiesList') {
            $this->technology->delete($id);
        }

        if ($table == 'Medialibrary') {
            $this->medialibrary->delete($id);
        }

        if ($table == 'Moderators') {
            $this->moderator->delete($id);
            require_once 'views/admin/profile.php'; exit();
        }
    }

    public function editItem(string $table, int $id) {
        if ($table == 'Projects') {
            $this->project->edit($id, $_POST);
        }
        
        if ($table == 'ProjectTeam') {
            $this->project->editProjectTeam($id, $_POST);
        }

        if ($table == 'Technologies') {
            $this->project->editProjectTechnologies($id, $_POST);
        }

        if ($table == 'Services') {
            $this->service->edit($id, $_POST);
        }

        if ($table == 'ProjectTypes') {
            $this->projectType->edit($id, $_POST);
        }

        if ($table == 'Team') {
            $this->teamMember->edit($id, $_POST);
        }

        if ($table == 'TechnologiesList') {
            $this->technology->edit($id, $_POST);
        }
    }

    public function addItem(string $table) {
        if ($table == 'Projects') {
            $this->project->add($_POST);
        }

        if ($table == 'Services') {
            $this->service->add($_POST);
        }        

        if ($table == 'ProjectTypes') {
            $this->projectType->add($_POST);
        }

        if ($table == 'Team') {
            $this->teamMember->add($_POST);
        }

        if ($table == 'TechnologiesList') {
            $this->technology->add($_POST);
        }

        if ($table == 'Moderators') {
            $this->moderator->add();
        }
    }

    public function getProjectTeam(int $id)
    {
        return $this->project->getProjectTeam($id);
    }

    public function getProjectTechnologies(int $id)
    {
        return $this->project->getProjectTechnologies($id);
    }

    public function getProjectImages(int $id)
    {
        return $this->project->getProjectImages($id);
    }
    
    public function loadFiles()
    {
        // $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
        // $uploaddir = '/var/www/uploads/';
        $uploaddir = __DIR__ . '/uploads/';
        $count = 0;

        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';

        foreach ($_FILES['userfile']['name'] as $value) {
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name'][$count]);
            
            if (move_uploaded_file($_FILES['userfile']['tmp_name'][$count], $uploadfile)) {
                // echo "Файл корректен и был успешно загружен.<br>";
            } else {
                // echo "Возможная атака с помощью файловой загрузки!<br>";
            }

            $this->medialibrary->add($_FILES['userfile']['name'][$count]);

            $count++;
        }

        // $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        // echo '<pre>';
        // if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        //     echo "Файл корректен и был успешно загружен.\n";
        // } else {
        //     echo "Возможная атака с помощью файловой загрузки!\n";
        // }

        // echo 'Некоторая отладочная информация:';
        // print_r($_FILES);

        // print "</pre>";
    }
}