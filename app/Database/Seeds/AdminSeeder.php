<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Data for admins
        $adminData = [
            [
                'name' => 'Admin 1',
                'email' => 'admin1@example.com',
                'password' => password_hash('adminpassword1', PASSWORD_DEFAULT),
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin' => date('Y-m-d H:i:s'),
                'role' => 'admin',
            ],
            [
                'name' => 'Admin 2',
                'email' => 'admin2@example.com',
                'password' => password_hash('adminpassword2', PASSWORD_DEFAULT),
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin' => date('Y-m-d H:i:s'),
                'role' => 'admin',
            ],
            [
                'name' => 'Admin 3',
                'email' => 'admin3@example.com',
                'password' => password_hash('adminpassword3', PASSWORD_DEFAULT),
                'registrationDate' => date('Y-m-d H:i:s'),
                'lastLogin' => date('Y-m-d H:i:s'),
                'role' => 'admin',
            ]
        ];

        // Insert the data into the 'user' table
        $this->db->table('user')->insertBatch($adminData);
    }
}
