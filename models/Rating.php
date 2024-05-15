<?php

namespace app\models;

use app\core\Model;
use app\models\User;

class Rating extends Model
{
    private $REG_BASE = 100;
    private $REG_BASE_RECR = 300;

    private $CONST_SUM = 11;
    
    private $LIKE_BASE = 7;

    public function getCoeffs($user_id) {
        $rating_cur = (new User)->findById($user_id)['rating'];
        $base_coeff = floor($rating_cur / 500);

        $this->LIKE_BASE -= $base_coeff;

        return [
            'LIKE_BASE' => $this->LIKE_BASE,
            'DISLIKE_BASE' => $this->CONST_SUM - $this->LIKE_BASE
        ];
    }

    public function updateRating($user_id) {
        $finalRating = 0;

        $rating = $this->REG_BASE;

        $coeffs = $this->getCoeffs($user_id);

        $query = "SELECT *
        FROM d_rated
        INNER JOIN d_replies on d_replies.id_reply = d_rated.reply_id
        WHERE author_id='$user_id'";
        if ($result = $this->db->connection->query($query)) {
            $output = $result->fetch_all(MYSQLI_ASSOC);
        }

        foreach ($output as $key => $value) {
            switch ($value['parameter']) {
                case 'L': {
                    $finalRating += $coeffs['LIKE_BASE'];
                    break;
                }
                case 'D': {
                    $finalRating -= $coeffs['DISLIKE_BASE'];
                    break;
                }
            }
        }

        $finalRating = $rating + $finalRating;

        $query = "UPDATE d_users SET `rating`='" . $finalRating . "' WHERE id_user=$user_id";

        return $this->db->connection->query($query);
    }
}