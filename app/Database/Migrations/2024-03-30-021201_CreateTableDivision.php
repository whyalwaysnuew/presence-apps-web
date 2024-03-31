<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDivision extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'division_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'division_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],

            'created_at' => [
                'type' => 'TIMESTAMP'
            ]
        ]);


        $this->forge->addKey('division_id', true);
        $this->forge->createTable('divisions', true);
    }

    public function down()
    {
        $this->forge->dropTable('divisions', true);
    }
}