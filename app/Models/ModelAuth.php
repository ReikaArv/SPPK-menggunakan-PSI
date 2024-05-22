<?php

namespace App\Models;

use App\Controllers\Auth;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ModelAuth extends Model

{
    protected $table = 'accounts';

    function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    function loginProcess($username)
    {
        $query = $this->builder->getWhere(['username' => $username]);
        $user   = $query->getRow();

        return $user;
    }
}
