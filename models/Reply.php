<?php

namespace app\models;

use app\core\Model;

class Reply extends Model
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

    public function getRating($id) {
        return $this->findById($id)['rating'];
    }

    public function likeRating($reply_id, $user_id) {
        $rating = 0;
        $output = [];
        $query = "SELECT * FROM d_replies WHERE id_reply='$reply_id'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        
        $rating = $output['rating'];
        
        $rating += 1;
        // var_dump($rating);

        $query = "UPDATE d_replies SET `rating`='" . $rating . "' WHERE id_reply=$reply_id";
        
        return $this->db->connection->query($query);
    }

    public function dislikeRating($reply_id, $user_id) {
        $rating = 0;
        $query = "SELECT * FROM d_replies WHERE id_reply='$reply_id'";

        if ($result = $this->db->connection->query($query)) {
            $rating = $result->fetch_assoc();
        }

        $rating = $rating['rating'];

        $rating -= 1;

        $query = "UPDATE d_replies SET `rating`='" . $rating . "' WHERE id_reply=$reply_id";
        
        return $this->db->connection->query($query);
    }

    public function findById(string $value) {
        $query = "SELECT * FROM d_replies WHERE id_reply='$value'";

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

    public function add($question_id, $text, $author_id) {
        $query = "INSERT INTO d_replies (`question_id`, `text`, `author_id`, `rating`) VALUES ('$question_id', '$text', '$author_id', 0)";

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