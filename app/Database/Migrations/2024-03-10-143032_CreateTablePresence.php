<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePresence extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'presence_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],

            'remark' => [
                'type' => 'CHAR',
                'constraint' => 50
            ],

            'presence_date' => [
                'type' => 'TIMESTAMP'
            ],

            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],

            'division' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],

            'created_at' => [
                'type' => 'TIMESTAMP'
            ]
        ]);

        $this->forge->addKey('presence_id', true);
        $this->forge->createTable('presences', true);
    }

    public function down()
    {
        $this->forge->dropTable('presences', true);
    }
}
