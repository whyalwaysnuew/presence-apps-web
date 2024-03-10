<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],

            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'address' => [
                'type' => 'VARCHAR',
                'constraint' =>  255,
                'null' => true
            ],

            'born_date' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],

            'level' => [
                'type' => 'CHAR',
                'constraint' => 100,
            ],

            'status' => [
                'type' => 'INT',
                'constraint' => 5
            ]
        ]);

        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
