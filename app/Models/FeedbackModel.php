<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model {
    protected $table = 'feedback';
    protected $primaryKey = 'feedbackID';
    protected $allowedFields = ['userID', 'roomID', 'rating', 'comment', 'submittedAt'];

    public function submitFeedback($userID, $roomID, $rating, $comment) {
        $data = [
            'userID' => $userID,
            'roomID' => $roomID,
            'rating' => $rating,
            'comment' => $comment,
            'submittedAt' => date('Y-m-d H:i:s'),
        ];
        return $this->save($data);
    }

    public function getFeedbackByRoom($roomID) {
        return $this->where('roomID', $roomID)->findAll();
    }

    public function getFeedbackByUser($userID) {
        return $this->where('userID', $userID)->findAll();
    }
}