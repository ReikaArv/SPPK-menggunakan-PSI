<?php

namespace App\Controllers;

use App\Models\ModelOperator;

class Operator extends BaseController
{

    public function index(): string
    {

        $hasil = new ModelOperator();


        //        get category names
        $category = $hasil->showDataCat()->getResultArray();

        //        step 1 / Data Awal

        $data = $hasil->showData()->getResultArray();

        //        step 2 / Mencari nilai Min dan Max
        // $maxC1 = max(array_column($data, 'c1'));
        // $maxC2 = max(array_column($data, 'c2'));
        // $maxC3 = max(array_column($data, 'c3'));
        // $maxC4 = max(array_column($data, 'c4'));
        // $maxC5 = max(array_column($data, 'c5'));
        // $maxC6 = max(array_column($data, 'c6'));
        // $minC7 = min(array_column($data, 'c7'));

        //        step 3 / normalisasi
        foreach ($data as $key => $value) {
            $data[$key]['normalisasi_c1'] = number_format($value['c1'] / $maxC1, 4);
            $data[$key]['normalisasi_c2'] = number_format($value['c2'] / $maxC2, 4);
            $data[$key]['normalisasi_c3'] = number_format($value['c3'] / $maxC3, 4);
            $data[$key]['normalisasi_c4'] = number_format($value['c4'] / $maxC4, 4);
            $data[$key]['normalisasi_c5'] = number_format($value['c5'] / $maxC5, 4);
            $data[$key]['normalisasi_c6'] = number_format($value['c6'] / $maxC6, 4);
            $data[$key]['normalisasi_c7'] = number_format($minC7 / $value['c7'], 4);
        }

        //        step 4 / mencari nilai rata-rata
        $avgC1 = number_format(array_sum(array_column($data, 'normalisasi_c1')) / 7, 4);
        $avgC2 = number_format(array_sum(array_column($data, 'normalisasi_c2')) / 7, 4);
        $avgC3 = number_format(array_sum(array_column($data, 'normalisasi_c3')) / 7, 4);
        $avgC4 = number_format(array_sum(array_column($data, 'normalisasi_c4')) / 7, 4);
        $avgC5 = number_format(array_sum(array_column($data, 'normalisasi_c5')) / 7, 4);
        $avgC6 = number_format(array_sum(array_column($data, 'normalisasi_c6')) / 7, 4);
        $avgC7 = number_format(array_sum(array_column($data, 'normalisasi_c7')) / 7, 4);

        //        step 5 / mencari nilai variasi Preferensi
        foreach ($data as $key => $value) {
            $data[$key]['variasi_c1'] = number_format(pow($value['normalisasi_c1'] - $avgC1, 2), 4);
            $data[$key]['variasi_c2'] = number_format(pow($value['normalisasi_c2'] - $avgC2, 2), 4);
            $data[$key]['variasi_c3'] = number_format(pow($value['normalisasi_c3'] - $avgC3, 2), 4);
            $data[$key]['variasi_c4'] = number_format(pow($value['normalisasi_c4'] - $avgC4, 2), 4);
            $data[$key]['variasi_c5'] = number_format(pow($value['normalisasi_c5'] - $avgC5, 2), 4);
            $data[$key]['variasi_c6'] = number_format(pow($value['normalisasi_c6'] - $avgC6, 2), 4);
            $data[$key]['variasi_c7'] = number_format(pow($value['normalisasi_c7'] - $avgC7, 2), 4);
        }

        $totalVariasiC1 = number_format(array_sum(array_column($data, 'variasi_c1')), 4);
        $totalVariasiC2 = number_format(array_sum(array_column($data, 'variasi_c2')), 4);
        $totalVariasiC3 = number_format(array_sum(array_column($data, 'variasi_c3')), 4);
        $totalVariasiC4 = number_format(array_sum(array_column($data, 'variasi_c4')), 4);
        $totalVariasiC5 = number_format(array_sum(array_column($data, 'variasi_c5')), 4);
        $totalVariasiC6 = number_format(array_sum(array_column($data, 'variasi_c6')), 4);
        $totalVariasiC7 = number_format(array_sum(array_column($data, 'variasi_c7')), 4);

        //        Step 6 / mencari nilai penyimpangan variasi preferensi
        $penyimpanganVariasiC1 = 1 - $totalVariasiC1;
        $penyimpanganVariasiC2 = 1 - $totalVariasiC2;
        $penyimpanganVariasiC3 = 1 - $totalVariasiC3;
        $penyimpanganVariasiC4 = 1 - $totalVariasiC4;
        $penyimpanganVariasiC5 = 1 - $totalVariasiC5;
        $penyimpanganVariasiC6 = 1 - $totalVariasiC6;
        $penyimpanganVariasiC7 = 1 - $totalVariasiC7;
        $totalPenyimpanganVariasi = number_format($penyimpanganVariasiC1 + $penyimpanganVariasiC2 + $penyimpanganVariasiC3 + $penyimpanganVariasiC4 + $penyimpanganVariasiC5 + $penyimpanganVariasiC6 + $penyimpanganVariasiC7, 4);

        //        Step 7 / menentukan bobot kriteria
        $w1 = number_format($penyimpanganVariasiC1 / $totalPenyimpanganVariasi, 4);
        $w2 = number_format($penyimpanganVariasiC2 / $totalPenyimpanganVariasi, 4);
        $w3 = number_format($penyimpanganVariasiC3 / $totalPenyimpanganVariasi, 4);
        $w4 = number_format($penyimpanganVariasiC4 / $totalPenyimpanganVariasi, 4);
        $w5 = number_format($penyimpanganVariasiC5 / $totalPenyimpanganVariasi, 4);
        $w6 = number_format($penyimpanganVariasiC6 / $totalPenyimpanganVariasi, 4);
        $w7 = number_format($penyimpanganVariasiC7 / $totalPenyimpanganVariasi, 4);

        //        Step 8 / mencari nilai PSI
        foreach ($data as $key => $value) {
            $data[$key]['psi_c1'] = number_format($value['normalisasi_c1'] * $w1, 4);
            $data[$key]['psi_c2'] = number_format($value['normalisasi_c2'] * $w2, 4);
            $data[$key]['psi_c3'] = number_format($value['normalisasi_c3'] * $w3, 4);
            $data[$key]['psi_c4'] = number_format($value['normalisasi_c4'] * $w4, 4);
            $data[$key]['psi_c5'] = number_format($value['normalisasi_c5'] * $w5, 4);
            $data[$key]['psi_c6'] = number_format($value['normalisasi_c6'] * $w6, 4);
            $data[$key]['psi_c7'] = number_format($value['normalisasi_c7'] * $w7, 4);
        }

        foreach ($data as $key => $value) {
            $data[$key]['psi_total'] = number_format($value['psi_c1'] + $value['psi_c2'] + $value['psi_c3'] + $value['psi_c4'] + $value['psi_c5'] + $value['psi_c6'] + $value['psi_c7'], 4);
        }

        //        Step 9 / perankingan
        usort($data, function ($a, $b) {
            return $b['psi_total'] <=> $a['psi_total'];
        });

        $hasilData = [
            'title' => 'Hasil Penghitungan PSI',
            'showData' => $hasil->showData()->getResult(),
            'data' => $data,
            'kategori' => $category,
        ];
        return view('Operator/viewHasil', $hasilData);
    }

    public function updateKategori()
    {
        helper('form');
        $hasil = new ModelOperator();
        $category = $hasil->showDataCat()->getResultArray();
        $data = [
            'title' => 'Update Kategori',
            'kategori' => $category,
        ];
        return view('Operator/viewUpdateKategori', $data);
    }

    public function updateData()
    {

        $op = new ModelOperator();
        $id = $this->request->getPost('id');
        $updatedata = [
            'nama_kategori' => $this->request->getPost('nama'),
            'deskripsi_kategori ' => $this->request->getPost('desc'),
        ];

        // var_dump($data);
        $dataUpdate = $op->updateData($updatedata, $id);


        if ($dataUpdate) {
            return redirect()->to('operator/updateKategori');
        } else {
            echo 'error';
        }
    }
}
