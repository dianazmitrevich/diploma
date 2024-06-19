<?php

namespace app\models;

use app\core\Model;

class Vacancy extends Model
{
    public function findById(string $value) {
        $query = "SELECT * FROM d_vacancies WHERE id_vacancy='$value'";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_assoc();
        }

        return $result ? $output : [];
    }

    public function getAll() {
        $query = "SELECT d_vacancies.id_vacancy, d_topics.id_topic as vacancy_id, d_topics.name as vacancy_name, d_vacancies.text as vacancy_text, d_levels.name as vacancy_level, d_companies.name as vacancy_company, d_companies.id_company
        FROM d_vacancies
        INNER JOIN d_topics on d_topics.id_topic = d_vacancies.topic_id
        INNER JOIN d_users on d_users.id_user = d_vacancies.author_id
        INNER JOIN d_companies on d_companies.id_company = d_users.company_id
        INNER JOIN d_levels on d_levels.id_level = d_vacancies.level_id";
        
        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getByAuthor($author_id) {
        $query = "SELECT d_vacancies.id_vacancy, d_topics.id_topic as vacancy_id, d_topics.name as vacancy_name, d_vacancies.text as vacancy_text, d_levels.name as vacancy_level, d_companies.name as vacancy_company, d_companies.id_company
        FROM d_vacancies
        INNER JOIN d_topics on d_topics.id_topic = d_vacancies.topic_id
        INNER JOIN d_users on d_users.id_user = d_vacancies.author_id
        INNER JOIN d_companies on d_companies.id_company = d_users.company_id
        INNER JOIN d_levels on d_levels.id_level = d_vacancies.level_id
        WHERE d_vacancies.author_id=$author_id";
        
        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getResponses($id_vacancy) {
        $query = "SELECT *
        FROM d_vacanced
        INNER JOIN d_users on d_users.id_user = d_vacanced.user_id
        WHERE d_vacanced.vacancy_id=$id_vacancy";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getAllResponses() {
        $query = "SELECT d_topics.id_topic, d_users.rating as user_rating, d_users.full_name as user_name, d_users.username as user_login, d_users.email as user_email, d_users.avatar as user_avatar, d_topics.name as position_name
        FROM d_vacanced
        INNER JOIN d_users on d_users.id_user = d_vacanced.user_id
        INNER JOIN d_vacancies on d_vacanced.vacancy_id = d_vacancies.id_vacancy
        INNER JOIN d_topics on d_topics.id_topic = d_vacancies.topic_id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function makeResponse($user_id, $vacancy_id) {
        $query = "INSERT INTO d_vacanced (`user_id`, `vacancy_id`) VALUES ('$user_id', '$vacancy_id')";

        return $this->db->connection->query($query);
    }

    public function isVacanced($vacancy_id, $user_id) {
        $query = "SELECT *
        FROM d_vacanced
        WHERE d_vacanced.vacancy_id=$vacancy_id AND d_vacanced.user_id=$user_id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function getMyResponces($user_id) {
        $query = "SELECT d_topics.name as vacancy_name, d_levels.name as vacancy_level, d_companies.name as vacancy_company, d_vacancies.id_vacancy, d_vacancies.text as vacancy_text
        FROM d_vacanced
        INNER JOIN d_vacancies on d_vacanced.vacancy_id = d_vacancies.id_vacancy
        INNER JOIN d_users on d_users.id_user = d_vacancies.author_id
        INNER JOIN d_topics on d_topics.id_topic = d_vacancies.topic_id
        INNER JOIN d_companies on d_companies.id_company = d_users.company_id
        INNER JOIN d_levels on d_levels.id_level = d_vacancies.level_id
        WHERE d_vacanced.user_id=$user_id";

        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result ? $output : [];
    }

    public function remove($vacancy_id) {
        $query = "DELETE FROM d_vacanced WHERE vacancy_id=$vacancy_id";
        $this->db->connection->query($query);

        $query = "DELETE FROM d_vacancies WHERE id_vacancy=$vacancy_id";
    
        return $this->db->connection->query($query);
    }

    public function add($position, $level, $description, $author_id) {
        $query = "INSERT INTO d_vacancies (`topic_id`, `level_id`, `text`, `author_id`) VALUES ('$position', '$level', '$description', '$author_id')";

        return $this->db->connection->query($query);
    }
}