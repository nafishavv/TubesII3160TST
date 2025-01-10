<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table      = 'feedback';
    protected $primaryKey = 'feedbackID';
    protected $allowedFields = ['customerID', 'roomID', 'rating', 'comment', 'submittedAt'];
    protected $useTimestamps = false;

    // Fungsi untuk menyimpan feedback
    public function submitFeedback($data)
    {
        return $this->insert($data);
    }
}
