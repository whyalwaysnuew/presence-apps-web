<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $query = $this->db->table('users')->insert([
            'user_id' => $this->generateId(),
            'username' => 'admin',
            'password' => password_hash('123456'),
            'fullname' => 'Jerry Admin',
            'email' => 'jerry@esaunggul.com',
            'division' => 'DIV24033000001',
            'address' => 'Bitung',
            'born_date' => '',
            'level' => 'ADMIN',
            'status' => '1'
        ]);
    }

    private function generateId()
    {
        $lastId = $this->db->table($this->table)
            ->select('MAX(RIGHT(user_id, 11)) AS last_id')
            ->get();
        $lastMidId = $this->db->table($this->table)
            ->select('MAX(MID(user_id, 4, 6)) AS last_mid_id')
            ->get()
            ->getRow()
            ->last_mid_id;
        $midId = date('ymd');
        $char = "USR" . $midId;
        if ($lastMidId == $midId) {
            $tmp = ($lastId->getRow()->last_id) + 1;
            $id = substr($tmp, -5);
        } else {
            $id = "00001";
        }
        return $char . $id;
    }
}
