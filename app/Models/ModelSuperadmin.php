<?php

namespace App\Models;

use App\Controllers\Auth;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ModelSuperadmin extends Model

{
    protected $table = 'accounts';

    function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    // function get all users from table accoutns
    public function getAllAccounts()
    {
        return $this->builder->get();
    }

    public function addAdmin($data)
    {
        $this->builder->insert($data);
    }

    public function deleteAdmin($id)
    {
        $this->builder->delete(['id_user' => $id]);
    }
}
