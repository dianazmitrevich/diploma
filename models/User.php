<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
    private $id;
    private $username;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function findById(string $value) {
        $query = "SELECT *
        FROM d_users
        LEFT JOIN d_companies on d_companies.id_company = d_users.company_id
        WHERE id_user='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }
        
        return $result ? $output : [];
    }

    public function getRecruiters() {
        $query = "SELECT *
        FROM d_users
        INNER JOIN d_companies on d_companies.id_company = d_users.company_id
        WHERE company_id IS NOT NULL";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function isValidated($id_user) {
        $query = "SELECT *
        FROM d_users
        WHERE id_user=$id_user AND role='R'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function validate($id_user) {
        $query = "SELECT *
        FROM d_users
        WHERE id_user=$id_user AND role='R'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        
        if (!$output) {
            $query = "UPDATE d_users SET `role`='R' WHERE id_user=$id_user";
        } else {
            $query = "UPDATE d_users SET `role`='' WHERE id_user=$id_user";
        }

        return $this->db->connection->query($query);
    }

    public function updateLogin($login, $user_id) {
        $query = "UPDATE d_users SET `username`='$login' WHERE id_user=$user_id";

        return $this->db->connection->query($query);
    }

    public function findByUsername(string $value) {
        $query = "SELECT * FROM d_users WHERE username='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    // public function findByEmail(string $value) {
    //     $query = "SELECT * FROM d_users WHERE email='$value'";

    //     if ($result = $this->db->connection->query($query)) {
    //         $output = $result->fetch_assoc();
    //     }

    //     return $result ? $output : [];
    // }

    public function findByEmail(string $value) {
        $query = "SELECT * FROM d_users WHERE email = ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param("s", $value);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $output = $result->fetch_assoc();
        }
    
        $stmt->close();
        return $result ? $output : [];
    }

    public function add($role, $email, $full_name, $password, $company_id = null, $document_url = null) {
        $username = 'user' . rand(100000, 999999);
        if ($company_id) {
            $query = "INSERT INTO d_users (`role`, `email`, `full_name`, `pass`, `username`, `company_id`, `document_url`, `rating`) VALUES ('$role', '$email', '$full_name', '$password', '$username', '$company_id', '$document_url', '" . (new Rating)->REG_BASE_RECR . "')";
        } else {
            $query = "INSERT INTO d_users (`role`, `email`, `full_name`, `pass`, `username`, `document_url`) VALUES ('$role', '$email', '$full_name', '$password', '$username', '$document_url')";
        }

        return $this->db->connection->query($query);
    }

    public function edit($avatar, $full_name, $email, $login, $user_id) {
        $query = "UPDATE d_users SET `avatar`='" . $avatar . "', `full_name`='" . $full_name . "', `email`='" . $email . "', `username`='" . $login . "' WHERE id_user=$user_id";
        
        return $this->db->connection->query($query);
    }
}