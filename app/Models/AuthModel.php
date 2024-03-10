<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function generateId()
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

    public function checkUsername($username)
    {
        return $this->db->table($this->table)
                ->where('username', $username)
                ->countAllResults() === 0;
    }

    public function checkEmail($email)
    {
        return $this->db->table($this->table)
                ->where('email', $email)
                ->countAllResults() === 0;
    }

    public function register($data)
    {
        $query = $this->db->table($this->table)
                ->insert($data);

        return $query;
    }

    
}
