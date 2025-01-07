<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'roomID'          => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'type'            => ['type' => 'VARCHAR', 'constraint' => 100],
            'price'           => ['type' => 'DOUBLE'],
            'availability'    => ['type' => 'BOOLEAN'],
            'bedCount'        => ['type' => 'INT', 'unsigned' => true],
            'roomDescription' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('roomID', true);
        $this->forge->createTable('room');
    }

    public function down()
    {
        $this->forge->dropTable('room');
    }
}
