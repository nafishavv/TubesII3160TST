<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUserTable extends Migration
{
    public function up()
    {
        // Tambahkan kolom 'role' ke tabel 'user'
        $fields = [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'customer'],
                'default'    => 'customer',
                'null'       => false,
            ],
        ];

        // Menambahkan kolom 'role' ke tabel 'user'
        $this->forge->addColumn('user', $fields);

        // Update data yang sudah ada (set role menjadi 'customer')
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->update(['role' => 'customer']);
    }

    public function down()
    {
        // Hapus kolom 'role' dari tabel 'user'
        $this->forge->dropColumn('user', 'role');
    }
}
