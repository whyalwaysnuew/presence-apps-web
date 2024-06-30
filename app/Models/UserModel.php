<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';

    public function getData()
    {
        $query = $this->db->table($this->table)
                ->join('divisions', 'divisions.division_id = users.division', 'left')
                ->where('level !=', 'ADMIN')
                ->get()->getResult();

        return $query;
    }

    public function getDetail($id)
    {
        $query = $this->db->table($this->table)
                ->select([$this->table.'.*', 'divisions.division_name', 'divisions.division_id'])
                ->join('divisions', 'divisions.division_id = users.division', 'left')
                ->where('user_id', $id)
                ->get();

        return $query->getRow();
    }

    public function getDivision()
    {
        $query = $this->db->table('divisions')->get()->getResult();

        return $query;
    }

    public function deleteData($id)
    {
        $this->db->table($this->table)->where($this->primaryKey, $id)->delete();
    }
}
