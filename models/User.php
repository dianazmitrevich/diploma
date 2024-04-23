<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
    private $id;
    private $username;
    private $code;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getCode()
    {
        return $this->code;
    }

    public function findById(string $value) {
        $query = "SELECT * FROM d_users WHERE id_user='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function findByUsername(string $value) {
        $query = "SELECT * FROM d_users WHERE username='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function findByEmail(string $value) {
        $query = "SELECT * FROM d_users WHERE email='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function add($role, $email, $full_name, $password, $company_id = 0, $document_url = null) {
        $username = 'user' . rand(100000, 999999);
        $query = "INSERT INTO d_users (`role`, `email`, `full_name`, `pass`, `username`, `company_id`, `document_url`) VALUES ('$role', '$email', '$full_name', '$password', '$username', '$company_id', '$document_url')";

        return $this->db->connection->query($query);
    }

    public function edit($avatar, $full_name, $email, $login, $user_id) {
        $query = "UPDATE d_users SET `avatar`='" . $avatar . "', `full_name`='" . $full_name . "', `email`='" . $email . "', `username`='" . $login . "' WHERE id_user=$user_id";
        
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

    // public function edit(int $id, array $data)
    // {
    //     $pass = md5($data['password']);
    //     $query = "UPDATE Moderators SET `login`='" . $data['login'] . "', `password`='" . $pass . "' WHERE id=$id";

    //     return $this->db->connection->query($query);
    // }

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