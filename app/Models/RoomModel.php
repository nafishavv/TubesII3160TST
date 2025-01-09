<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'room';
    protected $primaryKey = 'roomID';
    protected $allowedFields = ['type', 'price', 'availability', 'bedCount', 'roomDescription'];

    protected $validationRules = [
        'type' => 'required|string|max_length[50]',
        'price' => 'required|integer|greater_than[0]',
        'bedCount' => 'required|integer|greater_than[0]',
    ];
    
    protected $validationMessages = [
        'type' => [
            'required' => 'Room type is required.',
            'string' => 'Room type must be a string.',
        ],
        'price' => [
            'required' => 'Price is required.',
            'integer' => 'Price must be an integer.',
            'greater_than' => 'Price must be greater than zero.',
        ],
        'bedCount' => [
            'required' => 'Bed count is required.',
            'integer' => 'Bed count must be an integer.',
            'greater_than' => 'Bed count must be greater than zero.',
        ],
    ];
    
    // Get all rooms
    public function getAllRooms()
    {
        return $this->findAll();
    }

    // Get available rooms
    public function getAvailableRooms()
    {
        return $this->where('availability', true)->findAll();
    }

    public function addRoom()
    {
        // Periksa autentikasi dan peran admin
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON([
                'status' => 'fail',
                'message' => 'Unauthorized access.'
            ])->setStatusCode(403);
        }
    
        $data = $this->request->getPost();
    
        // Tambahkan nilai default untuk availability dan roomDescription
        $data['availability'] = true; // default set to true
        if (empty($data['roomDescription'])) {
            $data['roomDescription'] = "No description provided.";
        }
    
        $roomModel = new RoomModel();
    
        if ($roomModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Room added successfully.'
            ]);
        }
    
        // Menampilkan error jika validasi gagal
        return $this->response->setJSON([
            'status' => 'fail',
            'message' => 'Failed to add room.',
            'errors' => $roomModel->errors()
        ])->setStatusCode(400);
    }
    
    // Update room availability
    public function updateAvailability($roomID, $availability)
    {
        return $this->update($roomID, ['availability' => $availability]);
    }

    // Update room price
    public function updatePrice($roomID, $price)
    {
        return $this->update($roomID, ['price' => $price]);
    }

    // Get room info
    public function getRoomInfo($roomID)
    {
        return $this->find($roomID);
    }
}