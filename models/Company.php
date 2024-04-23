<?php

namespace app\models;

use app\core\Model;

class Company extends Model
{
    private $id;
    private $login;
    private $code;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setLogin(string $login)
    {
        $this->login = $login;
    }
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function getCode()
    {
        return $this->code;
    }

    public function findById(string $value) {
        $query = "SELECT * FROM d_companies WHERE id_companu='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function add($role, $email, $full_name, $password) {
        $username = 'user' . rand(100000, 999999);
        $query = "INSERT INTO d_users (`role`, `email`, `full_name`, `pass`, `username`) VALUES ('$role', '$email', '$full_name', '$password', '$username')";

        return $this->db->connection->query($query);
    }
    
    // public function add()
    // {
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $key = '';
    //     $charactersLength = strlen($characters);
        
    //     for ($i = 0; $i < 6; $i++) {
    //         $key .= $characters[rand(0, $charactersLength - 1)];
    //     }
        
    //     $query = "INSERT INTO Moderators (`inviteKey`, `isAdmin`) VALUES ('$key', 0)";

    //     $this->db->connection->query($query);
    // }

    public function delete(int $id)
    {
        $query = "DELETE FROM Moderators WHERE id = $id";

        return $this->db->connection->query($query);
    }

    public function edit(int $id, array $data)
    {
        $pass = md5($data['password']);
        $query = "UPDATE Moderators SET `login`='" . $data['login'] . "', `password`='" . $pass . "' WHERE id=$id";

        return $this->db->connection->query($query);
    }

    public function getByParameter(string $parameter, $value) {
        $query = "SELECT * FROM Moderators WHERE $parameter='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function checkModerator(array $data) {
        $pass = md5($data['password']);
        
        $query = "SELECT * FROM Moderators WHERE `password`='" . $pass . "' AND `login`='" . $data['login'] . "'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getModerators() {
        $query = "SELECT * FROM Moderators WHERE isAdmin=0";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }
}