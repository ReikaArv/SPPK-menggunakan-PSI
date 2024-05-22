<?php

namespace App\Controllers;

use App\Models\ModelHasil;

class Hasil extends BaseController
{

    public function index(): string
    {
        helper('form');
        $hasil = new ModelHasil();
        $showData = $hasil->showData()->getResult();
        // foreach ($showData as $key => $value) {
        //     echo $value->nama;
        // }
        print_r($showData);
        // dd($showData);

        // START Mencari Nilai Max-Min //

        $getmaxmin = $hasil->getMaxMin();
        $arraymaxmin = [
            'maxc1' => $getmaxmin['maxc1'][0]->c1,
            'maxc2' => $getmaxmin['maxc2'][0]->c2,
            'maxc3' => $getmaxmin['maxc3'][0]->c3,
            'maxc4' => $getmaxmin['maxc4'][0]->c4,
            'maxc5' => $getmaxmin['maxc5'][0]->c5,
            'maxc6' => $getmaxmin['maxc6'][0]->c6,
            'minc7' => $getmaxmin['minc7'][0]->c7,
        ];

        // END Mencari Nilai Max-Min //
        $hasilData = [
            'title' => 'Data Siswa',
            'showData' => $hasil->showData()->getResult(),
            'arraymaxmin' => $arraymaxmin,
            // 'siswa' => $listSiswa,
        ];
        return view('Hasil/viewHasil', $hasilData);
    }

    public function normalisasi()
    {
        $hasil = new ModelHasil();
        $updatedata = [
            'id' => $this->request->getPost('id[]'),
            'nama' => $this->request->getPost('nama[]'),
            'c1' => $this->request->getPost('c1[]'),
            'c2' => $this->request->getPost('c2[]'),
            'c3' => $this->request->getPost('c3[]'),
            'c4' => $this->request->getPost('c4[]'),
            'c5' => $this->request->getPost('c5[]'),
            'c6' => $this->request->getPost('c6[]'),
            'c7' => $this->request->getPost('c7[]'),
        ];

        // dd($_GET);
        var_dump($this->request->getVar());

        $dataupdate = $hasil->normalisasi($updatedata);

        if ($dataupdate) {
            return redirect()->to('Hasil/viewNormalisasi');
        } else {
            echo 'error';
        }
    }
}
