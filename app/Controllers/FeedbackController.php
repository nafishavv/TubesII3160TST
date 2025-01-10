<?php

namespace App\Controllers;

use App\Models\FeedbackModel;
use App\Models\ReservationModel;

class FeedbackController extends BaseController
{
    // Menampilkan halaman feedback dengan data kamar yang pernah direservasi
    public function feedbackForm()
    {
        // Ambil roomID dari sesi atau data lainnya
        $roomID = session()->get('roomID');
        
        return view('customer/feedbackForm', [
            'roomID' => $roomID
        ]);
    }

    // Menyimpan feedback ke database
    public function submitFeedback()
    {
        $feedbackModel = new FeedbackModel();

        // Ambil data dari form yang dikirimkan
        $data = [
            'customerID'   => session()->get('customerID'), // Ambil userID dari session
            'roomID'   => $this->request->getPost('roomID'), // Room ID dari form
            'rating'   => $this->request->getPost('rating'), // Rating dari form
            'comment'  => $this->request->getPost('comment'), // Comment dari form
            'submittedAt' => date('Y-m-d H:i:s') // Timestamp saat feedback dikirim
        ];

        // Simpan data ke dalam database
        if ($feedbackModel->insert($data)) {
            return redirect()->to('/customer/home')->with('success', 'Feedback submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to submit feedback!');
        }
    }
    // Di AdminController.php
public function viewFeedback()
{
    // Ambil data feedback dari model
    $feedbackModel = new \App\Models\FeedbackModel();
    $data['feedbacks'] = $feedbackModel->findAll(); // Atau sesuaikan dengan query sesuai kebutuhan

    // Kirim data ke view
    return view('admin/view_feedback', $data);
}

}
