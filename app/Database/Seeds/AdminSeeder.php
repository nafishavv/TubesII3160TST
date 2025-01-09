<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminData = [
            [
                'name'             => 'Admin 1',
                'email'            => 'admin1@example.com',
                'password'         => password_hash('admin123', PASSWORD_DEFAULT),
                'role'             => 'Receptionist',
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin'        => null,
            ],
            [
                'name'             => 'Admin 2',
                'email'            => 'admin2@example.com',
                'password'         => password_hash('admin456', PASSWORD_DEFAULT),
                'role'             => 'Manager',
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin'        => null,
            ],
            [
                'name'             => 'Admin 3',
                'email'            => 'admin3@example.com',
                'password'         => password_hash('admin789', PASSWORD_DEFAULT),
                'role'             => 'Receptionist',
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin'        => null,
            ],
        ];

        $this->db->table('admin')->insertBatch($adminData);
    }
}
