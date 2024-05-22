<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ModelOperator extends Model
{
    protected $table = 'nilai_siswa';
    protected $tablecat = 'kategori';
    protected $tablesiswa = 'siswa';


    function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    function showData()
    {
        return $this->builder->get();
    }

    function showRelationalData()
    {
        return $this->builder
            ->select($this->table . '.*, ' . $this->tablecat . '.name as nama_kategori, ' . $this->tablecat . '.type, ' . $this->tablesiswa . '.name as nama_siswa')
            ->join($this->tablecat, sprintf('%s.id = %s.kategori_id', $this->tablecat, $this->table))
            ->join($this->tablesiswa, sprintf('%s.id = %s.siswa_id', $this->tablesiswa, $this->table))
            ->get();
    }

    function showDataSiswa()
    {
        return $this->db->table($this->tablesiswa)->get();
    }

    function showDataNilaiSiswa()
    {
        return $this->db->table($this->tablesiswa)
            ->select($this->tablesiswa . ".*, " . $this->table . ".nilai, " . $this->table . ".kategori_id")
            ->join($this->table, sprintf('%s.siswa_id = %s.id', $this->table, $this->tablesiswa))
            ->get();
    }

    function showSingleDataNilaiSiswa($id)
    {
        return $this->db->table($this->tablesiswa)
            ->select($this->tablesiswa . ".*, " . $this->table . ".nilai, " . $this->table . ".kategori_id")
            ->join($this->table, sprintf('%s.siswa_id = %s.id', $this->table, $this->tablesiswa))
            ->where($this->table . '.siswa_id', $id)
            ->get();
    }

    function showDataCat()
    {
        return $this->db->table($this->tablecat)->get();
    }

    function getLatestSiswaId()
    {
        return $this->db->table($this->tablesiswa)->select('id')->orderBy('id', 'DESC')->limit(1)->get()->getRow()->id;
    }

    function addSiswaData($data)
    {

        return $this->db->table($this->tablesiswa)->insert($data);
    }

    function addSiswaAdditionalData($data)
    {
        $this->db->transStart();
        $this->db->table($this->table)->insert($data);
        $this->db->transComplete();
        return $this->db->transStatus();
    }

    function updateSiswaData($data)
    {
        return $this->db->table($this->table)->update($data, ['siswa_id' => $data['siswa_id'], 'kategori_id' => $data['kategori_id']]);
    }

    function deleteSiswaData($id)
    {
        return $this->db->table($this->tablesiswa)->delete(['id' => $id]);
    }

    function addCategoryData($data)
    {
        return $this->db->table($this->tablecat)->insert($data);
    }

    function updateCategoryData($data, $id)
    {
        return $this->db->table($this->tablecat)->update($data, ['id' => $id]);
    }

    function deleteCategoryData($id)
    {
        return $this->db->table($this->tablecat)->delete(['id' => $id]);
    }
}
