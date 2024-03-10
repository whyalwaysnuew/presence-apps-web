<?php

namespace App\Models;

use CodeIgniter\Model;

class PresenceModel extends Model
{
    protected $table            = 'presences';
    protected $primaryKey       = 'id';
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
            ->select('MAX(RIGHT(presence_id, 11)) AS last_id')
            ->get();
        $lastMidId = $this->db->table($this->table)
            ->select('MAX(MID(presence_id, 4, 6)) AS last_mid_id')
            ->get()
            ->getRow()
            ->last_mid_id;
        $midId = date('ymd');
        $char = "PRE" . $midId;
        if ($lastMidId == $midId) {
            $tmp = ($lastId->getRow()->last_id) + 1;
            $id = substr($tmp, -5);
        } else {
            $id = "00001";
        }
        return $char . $id;
    }

    public function store($value)
    {
        $query = $this->db->table($this->table)->insert($value);

        return $query;
    }

    public function getPresenceData()
    {
        $query = $this->db->table($this->table)->get();

        return $query->getResult();
    }
}
