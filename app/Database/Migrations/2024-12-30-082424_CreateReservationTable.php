<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'reservationID'   => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'userID'          => ['type' => 'INT', 'unsigned' => true],
            'roomID'          => ['type' => 'INT', 'unsigned' => true],
            'checkInDate'     => ['type' => 'DATETIME'],
            'checkOutDate'    => ['type' => 'DATETIME'],
            'status'          => ['type' => 'ENUM', 'constraint' => ['pending', 'confirmed', 'cancelled']],
            'createdAt'       => ['type' => 'DATETIME', 'null' => false],
            'totalPrice'      => ['type' => 'DOUBLE']
        ]);
        $this->forge->addKey('reservationID', true);
        $this->forge->addForeignKey('userID', 'user', 'userID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('roomID', 'room', 'roomID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservation');
    }

    public function down()
    {
        $this->forge->dropTable('reservation');
    }
}