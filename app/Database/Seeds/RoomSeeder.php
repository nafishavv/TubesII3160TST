<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $roomData = [
            [
                'roomTypeID'   => 1,
                'floorNumber'  => 1,
                'availability' => true,
            ],
            [
                'roomTypeID'   => 1,
                'floorNumber'  => 2,
                'availability' => true,
            ],
            [
                'roomTypeID'   => 2,
                'floorNumber'  => 1,
                'availability' => true,
            ],
            [
                'roomTypeID'   => 2,
                'floorNumber'  => 3,
                'availability' => true,
            ],
            [
                'roomTypeID'   => 3,
                'floorNumber'  => 2,
                'availability' => true,
            ],
        ];

        $this->db->table('room')->insertBatch($roomData);
    }
}
