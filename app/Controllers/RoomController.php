<?php

namespace App\Controllers;

use App\Models\RoomModel;
use CodeIgniter\Controller;

class RoomController extends Controller
{
    // Get all rooms
    public function getAllRooms()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'User not authenticated.'])->setStatusCode(401);
        }

        $roomModel = new RoomModel();
        $rooms = $roomModel->findAll();

        return $this->response->setJSON($rooms);
    }

    // Get available rooms
    public function getAvailableRooms()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'User not authenticated.'])->setStatusCode(401);
        }

        $roomModel = new RoomModel();
        $rooms = $roomModel->where('availability', true)->findAll();

        return $this->response->setJSON($rooms);
    }

    // Add a new room
    public function addRoom()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'Unauthorized access.'])->setStatusCode(403);
        }

        $data = $this->request->getPost();

        $roomModel = new RoomModel();
        if ($roomModel->addRoom($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Room added successfully.']);
        }

        return $this->response->setJSON(['status' => 'fail', 'message' => 'Failed to add room.'])->setStatusCode(400);
    }

    // Update room availability
    public function updateAvailability($roomID)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'Unauthorized access.'])->setStatusCode(403);
        }

        $availability = $this->request->getPost('availability');
        $roomModel = new RoomModel();

        if ($roomModel->update($roomID, ['availability' => $availability])) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Room availability updated.']);
        }

        return $this->response->setJSON(['status' => 'fail', 'message' => 'Failed to update room availability.'])->setStatusCode(400);
    }

    // Update room price
    public function updatePrice($roomID)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'Unauthorized access.'])->setStatusCode(403);
        }

        $price = $this->request->getPost('price');
        $roomModel = new RoomModel();

        if ($roomModel->update($roomID, ['price' => $price])) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Room price updated.']);
        }

        return $this->response->setJSON(['status' => 'fail', 'message' => 'Failed to update room price.'])->setStatusCode(400);
    }
}
