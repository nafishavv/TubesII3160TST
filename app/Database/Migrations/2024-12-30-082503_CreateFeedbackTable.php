<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'feedbackID'      => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'userID'          => ['type' => 'INT', 'unsigned' => true],
            'roomID'          => ['type' => 'INT', 'unsigned' => true],
            'rating'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'comment'         => ['type' => 'TEXT', 'null' => true],
            'submittedAt'     => ['type' => 'DATETIME', 'null' => false]
        ]);

        $this->forge->addKey('feedbackID', true);
        $this->forge->addForeignKey('userID', 'user', 'userID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('roomID', 'room', 'roomID', 'CASCADE', 'CASCADE'); 

        $this->forge->createTable('feedback');
    }

    public function down()
    {
        $this->forge->dropTable('feedback');
    }
}