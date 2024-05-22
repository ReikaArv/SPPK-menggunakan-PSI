<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ModelSiswa extends Model
{
    protected $table = 'siswa';


    function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    function showData()
    {
        return $this->builder->get();
    }

    function updateData($updatedata, $id)
    {

        return $this->builder->update($updatedata, ['id' => $id]);
    }

    function deleteData($id)
    {
        return $this->builder->delete(['id' => $id]);
    }

    function addData($data) {

        return $this->builder->insert($data);
    }
}
