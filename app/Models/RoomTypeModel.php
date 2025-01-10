<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomTypeModel extends Model
{
    protected $table = 'roomtype';
    protected $primaryKey = 'roomTypeID';
    protected $allowedFields = ['name', 'price', 'bedCount', 'roomTypeDescription'];
    protected $useTimestamps = false;

    public function getRoomTypeInfo($roomTypeID)
    {
        return $this->find($roomTypeID);
    }

    public function getAllRoomTypes()
    {
        return $this->findAll();
    }
}
