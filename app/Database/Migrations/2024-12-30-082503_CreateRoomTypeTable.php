<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomTypeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'roomTypeID'         => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'name'               => ['type' => 'VARCHAR', 'constraint' => 100],
            'price'              => ['type' => 'DOUBLE'],
            'bedCount'           => ['type' => 'INT', 'unsigned' => true],
            'roomTypeDescription'=> ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('roomTypeID', true);
        $this->forge->createTable('roomtype');
    }

    public function down()
    {
        $this->forge->dropTable('roomtype');
    }
}