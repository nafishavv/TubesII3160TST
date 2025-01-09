<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'adminID'          => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'email'            => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'             => ['type' => 'VARCHAR', 'constraint' => 50],
            'registrationDate' => ['type' => 'DATETIME', 'null' => false],
            'lastLogin'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('adminID', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}