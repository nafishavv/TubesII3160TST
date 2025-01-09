<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customerData = [
            [
                'name'             => 'Alice',
                'email'            => 'alice@example.com',
                'password'         => password_hash('password123', PASSWORD_DEFAULT),
                'totalPoint'       => 100.5,
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin'        => null,
            ],
            [
                'name'             => 'Bob',
                'email'            => 'bob@example.com',
                'password'         => password_hash('password456', PASSWORD_DEFAULT),
                'totalPoint'       => 200.75,
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin'        => null,
            ],
            [
                'name'             => 'Charlie',
                'email'            => 'charlie@example.com',
                'password'         => password_hash('password789', PASSWORD_DEFAULT),
                'totalPoint'       => 150.25,
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin'        => null,
            ],
        ];

        $this->db->table('customer')->insertBatch($customerData);
    }
}
