<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'customerID'       => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'email'            => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'totalPoint'       => ['type' => 'DOUBLE', 'default' => 0],
            'registrationDate' => ['type' => 'DATETIME', 'null' => false],
            'lastLogin'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('customerID', true);
        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}