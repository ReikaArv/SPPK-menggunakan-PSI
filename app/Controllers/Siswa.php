<?php

namespace App\Controllers;

use App\Models\ModelSiswa;
use App\Models\ModelOperator;

class Siswa extends BaseController
{
    // protected $ModelSiswa;
    // public function __construct()
    // {
    //     $this->ModelSiswa = new ModelSiswa();
    // }


    public function index(): string
    {
        helper('form');

        $siswa = new ModelSiswa();
        $kategori = new ModelOperator();
        $showData = $siswa->showData()->getResultArray();
        $showKat = $kategori->showDataCat()->getResultArray();
        $siswaData = [
            'title' => 'Data Siswa',
            'showData' => $showData,
            'kategori' => $showKat,
        ];
        return view('Siswa/viewSiswa', $siswaData);
        // return view('siswa/viewSiswaBaru', $siswaData);
        // return view('Siswa/tables');
    }

    public function updateData()
    {
        $siswa = new ModelSiswa();
        $id = $this->request->getPost('id');
        $updatedata = [
            'nama' => $this->request->getPost('nama'),
            'c1' => $this->request->getPost('c1'),
            'c2' => $this->request->getPost('c2'),
            'c3' => $this->request->getPost('c3'),
            'c4' => $this->request->getPost('c4'),
            'c5' => $this->request->getPost('c5'),
            'c6' => $this->request->getPost('c6'),
            'c7' => $this->request->getPost('c7'),
        ];

        // var_dump($data);
        $dataUpdate = $siswa->updateData($updatedata, $id);


        if ($dataUpdate) {
            return redirect()->to('siswa');
        } else {
            echo 'error';
        }
    }

    public function deleteData()
    {
        $siswa = new ModelSiswa();
        $id = $this->request->getPost('id');
        $siswa->deleteData($id);
        return redirect()->to('siswa');
    }

    public function addData()
    {
        helper('form');
        $siswa = new ModelSiswa();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'c1' => $this->request->getPost('c1'),
            'c2' => $this->request->getPost('c2'),
            'c3' => $this->request->getPost('c3'),
            'c4' => $this->request->getPost('c4'),
            'c5' => $this->request->getPost('c5'),
            'c6' => $this->request->getPost('c6'),
            'c7' => $this->request->getPost('c7'),
        ];

        $siswa->addData($data);
        return redirect()->to('siswa');
    }
}
