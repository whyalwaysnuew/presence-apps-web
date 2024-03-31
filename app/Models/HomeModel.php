<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    public function getTotalDivision()
    {
        $query = $this->db->table('divisions');

        return $query->countAllResults();
    }

    public function getTotalEmployee()
    {
        $query = $this->db->table('users')->where('level !=', 'ADMIN');

        return $query->countAllResults();
    }

    public function getTotalPresence()
    {
        $query = $this->db->table('presences');

        return $query->countAllResults();
    }
}
