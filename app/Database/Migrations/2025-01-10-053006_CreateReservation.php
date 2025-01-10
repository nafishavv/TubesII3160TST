<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'reservationID' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'customerID' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'roomID' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'checkInDate' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'checkOutDate' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'confirmed', 'cancelled', 'completed'],
                'default'    => 'Confirmed',
            ],
            'createdAt' => [
                'type'    => 'DATETIME',
                'default' => 'TIMESTAMP',
            ],
            'totalPrice' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('reservationID', true);

        $this->forge->addForeignKey('customerID', 'customer', 'customerID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('roomID', 'room', 'roomID', 'CASCADE', 'CASCADE');

        $this->forge->createTable('reservation');
    }

    public function down()
    {
        $this->forge->dropTable('reservation', true);
    }
}
