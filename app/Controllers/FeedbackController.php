<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class FeedbackController extends BaseController {
    protected $feedbackModel;

    public function __construct() {
        $this->feedbackModel = new FeedbackModel();
    }

    public function submit() {
        // Implementasi untuk submit feedback
    }

    public function getFeedbackByRoom($roomID) {
        $feedback = $this->feedbackModel->getFeedbackByRoom($roomID);
        return view('feedback/room_feedback', ['feedback' => $feedback]);
    }
}
