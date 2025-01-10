<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'room'; // Nama tabel di database
    protected $primaryKey = 'roomID'; // Primary key tabel
    protected $allowedFields = [
        'roomID', 
        'roomTypeID', 
        'floorNumber', 
        'availability'
    ]; // Kolom-kolom yang boleh dimodifikasi

    // Mengambil semua data room
    public function getAllRooms()
    {
        return $this->findAll();
    }

    // Mengambil room berdasarkan tipe
    public function getRoomByType($roomTypeID)
    {
        return $this->where('roomTypeID', $roomTypeID)->findAll();
    }

    // Mengambil room yang tersedia
    public function getAvailableRooms()
    {
        return $this->where('availability', true)->findAll();
    }

    // Mengupdate informasi room
    public function updateRoom($roomID, $data)
    {
        return $this->update($roomID, $data);
    }

    // Menghapus room
    public function deleteRoom($roomID)
    {
        return $this->delete($roomID);
    }

    // Menambahkan room baru
    public function addRoom($roomTypeID, $floorNumber, $availability)
    {
        return $this->insert([
            'roomTypeID' => $roomTypeID,
            'floorNumber' => $floorNumber,
            'availability' => $availability,
        ]);
    }


}
