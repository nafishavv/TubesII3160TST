<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model {
    protected $table = 'room';
    protected $primaryKey = 'roomID';
    protected $allowedFields = ['type', 'price', 'availability', 'bedCount', 'roomDescription'];

    public function addRoom($type, $price, $availability, $bedCount, $roomDescription) {
        $data = [
            'type' => $type,
            'price' => $price,
            'availability' => $availability,
            'bedCount' => $bedCount,
            'roomDescription' => $roomDescription,
        ];
        return $this->save($data);
    }

    public function updateAvailability($roomID, $availability) {
        return $this->update($roomID, ['availability' => $availability]);
    }

    public function getAvailableRooms() {
        return $this->where('availability', true)->findAll();
    }

    public function getAllRooms() {
        return $this->findAll();
    }
}
