<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'roomID'        => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'roomTypeID'    => ['type' => 'INT', 'unsigned' => true],
            'floorNumber'   => ['type' => 'INT', 'unsigned' => true],
            'availability'  => ['type' => 'BOOLEAN', 'default' => true],
        ]);
        $this->forge->addKey('roomID', true);
        $this->forge->addForeignKey('roomTypeID', 'roomtype', 'roomTypeID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('room');
    }

    public function down()
    {
        $this->forge->dropTable('room');
    }
}