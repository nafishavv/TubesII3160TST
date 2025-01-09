<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        $roomTypeData = [
            [
                'name'               => 'Standard',
                'price'              => 500000,
                'bedCount'           => 1,
                'roomTypeDescription'=> 'Standard room with one king-sized bed.',
            ],
            [
                'name'               => 'Deluxe',
                'price'              => 750000,
                'bedCount'           => 2,
                'roomTypeDescription'=> 'Deluxe room with two queen-sized beds.',
            ],
            [
                'name'               => 'Suite',
                'price'              => 1500000,
                'bedCount'           => 3,
                'roomTypeDescription'=> 'Luxury suite with three king-sized beds.',
            ],
        ];

        $this->db->table('roomtype')->insertBatch($roomTypeData);
    }
}
