<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userID'          => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'name'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'email'           => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'registrationDate'=> ['type' => 'DATETIME', 'null' => false],
            'lastLogin'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('userID', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}