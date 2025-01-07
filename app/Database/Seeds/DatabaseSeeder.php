<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Data untuk tabel user
        $userData = [
            [
                'name' => 'Alice',
                'email' => 'alice@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Charlie',
                'email' => 'charlie@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin' => date('Y-m-d H:i:s'),
            ]
        ];

        // Menambahkan data ke tabel user
        $this->db->table('user')->insertBatch($userData);

        // Data untuk tabel room
        $roomData = [
            [
                'type' => 'Deluxe',
                'price' => 100.00,
                'availability' => true,
                'bedCount' => 2,
                'roomDescription' => 'A spacious deluxe room with a beautiful view.',
            ],
            [
                'type' => 'Standard',
                'price' => 50.00,
                'availability' => true,
                'bedCount' => 1,
                'roomDescription' => 'A cozy room perfect for solo travelers.',
            ],
            [
                'type' => 'Suite',
                'price' => 200.00,
                'availability' => true,
                'bedCount' => 3,
                'roomDescription' => 'A luxurious suite with all premium amenities.',
            ],
            [
                'type' => 'Standard',
                'price' => 50.00,
                'availability' => true,
                'bedCount' => 1,
                'roomDescription' => 'A cozy room perfect for solo travelers.',
            ]
        ];

        // Menambahkan data ke tabel room
        $this->db->table('room')->insertBatch($roomData);

        // Data untuk tabel reservation
        $reservationData = [
            [
                'userID' => 1,
                'roomID' => 1,
                'checkInDate' => '2024-12-31 14:00:00',
                'checkOutDate' => '2025-01-02 12:00:00',
                'status' => 'Confirmed',
                'createdAt' => date('Y-m-d H:i:s'),
            ],
            [
                'userID' => 2,
                'roomID' => 2,
                'checkInDate' => '2024-12-25 14:00:00',
                'checkOutDate' => '2024-12-28 12:00:00',
                'status' => 'Pending',
                'createdAt' => date('Y-m-d H:i:s'),
            ],
            [
                'userID' => 3,
                'roomID' => 3,
                'checkInDate' => '2024-12-20 14:00:00',
                'checkOutDate' => '2024-12-22 12:00:00',
                'status' => 'Confirmed',
                'createdAt' => date('Y-m-d H:i:s'),
            ],

        ];

        // Menambahkan data ke tabel reservation
        $this->db->table('reservation')->insertBatch($reservationData);

        // Data untuk tabel feedback
        $feedbackData = [
            [
                'userID' => 1,
                'roomID' => 1,
                'rating' => 5,
                'comment' => 'Amazing room, very comfortable!',
                'submittedAt' => date('Y-m-d H:i:s'),
            ],
            [
                'userID' => 2,
                'roomID' => 2,
                'rating' => 4,
                'comment' => 'Good room, but needs better lighting.',
                'submittedAt' => date('Y-m-d H:i:s'),
            ],
            [
                'userID' => 3,
                'roomID' => 3,
                'rating' => 5,
                'comment' => 'Perfect suite, loved the view!',
                'submittedAt' => date('Y-m-d H:i:s'),
            ],
            [
                'userID' => 1,
                'roomID' => 4,
                'rating' => 3,
                'comment' => 'Not bad',
                'submittedAt' => date('Y-m-d H:i:s'),
            ]
        ];

        // Menambahkan data ke tabel feedback
        $this->db->table('feedback')->insertBatch($feedbackData);
    }
}
