<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use CodeIgniter\Controller;

class ReservationController extends Controller
{
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $reservationModel = new ReservationModel();
            $userID = session()->get('userID');  // Asumsi sudah ada session user
            $roomID = $this->request->getPost('roomID');
            $checkInDate = $this->request->getPost('checkInDate');
            $checkOutDate = $this->request->getPost('checkOutDate');
            
            $reservationModel->createReservation($userID, $roomID, $checkInDate, $checkOutDate);
            return redirect()->to('/reservation/list');
        }

        return view('reservation/create');
    }

    public function list()
    {
        $reservationModel = new ReservationModel();
        $userID = session()->get('userID');  // Asumsi sudah ada session user
        $reservations = $reservationModel->getReservationByUser($userID);

        return view('reservation/list', ['reservations' => $reservations]);
    }

    public function cancel($reservationID)
    {
        $reservationModel = new ReservationModel();
        $reservationModel->cancelReservation($reservationID);
        return redirect()->to('/reservation/list');
    }

    public function updateStatus($reservationID, $status)
    {
        $reservationModel = new ReservationModel();
        $reservationModel->updateReservationStatus($reservationID, $status);
        return redirect()->to('/reservation/list');
    }
    
    // Function to get reservations by user ID
    public function listByUser($userID)
    {
        $reservationModel = new ReservationModel();

        // Get reservations by user ID
        $reservations = $reservationModel->getReservationByUser($userID);

        if ($reservations) {
            return $this->response->setJSON([
                'status' => 'success',
                'reservations' => $reservations
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No reservations found for this user'
            ]);
        }
    }
}
