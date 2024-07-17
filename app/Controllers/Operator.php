<?php

namespace App\Controllers;

use App\Models\ModelOperator;

class Operator extends BaseController
{
    public function index(): string
    {
        $model = new ModelOperator();


        //        get category names
        $siswa = $model->showDataSiswa()->getResultArray();
        $categories = $model->showDataCat()->getResultArray();
        $nilai = $model->showData()->getResultArray();

        // step 2 mencari minmax

        $nilaiCategories = array_map(function ($category) use ($nilai) {
            $filteredValues = array_filter($nilai, fn ($item) => $item['kategori_id'] == $category['id']);
            $columnValues = array_column($filteredValues, 'nilai');

            return $columnValues ? ($category['type'] == 'max' ? max($columnValues) : min($columnValues)) : 1;
        }, $categories);

        // step 3 normalisasi
        $nilai = array_map(function ($nilai) use ($categories, $nilaiCategories) {
            $kategori = $categories[array_search($nilai['kategori_id'], array_column($categories, 'id'))];
            $filteredValues = $kategori['type'] == 'max' ? $nilai['nilai'] / $nilaiCategories[array_search($kategori['id'], array_column($categories, 'id'))] : $nilaiCategories[array_search($kategori['id'], array_column($categories, 'id'))] / $nilai['nilai'];

            return array_merge($nilai, ['normalisasi' => number_format($filteredValues, 4)]);
        }, $nilai);

        // step 4 mencari nilai rata-rata
        $categories = array_map(function ($category) use ($nilai, $categories) {
            $filteredValues = array_filter($nilai, fn ($item) => $item['kategori_id'] == $category['id']);
            $columnValues = array_sum(array_column($filteredValues, 'normalisasi'));

            return array_merge($category, ['avg' => number_format($columnValues / count($categories), 4)]);
        }, $categories);

        // step 5 mencari nilai variasi preferensi per kategori
        $categories = array_map(function ($category) use ($nilai) {
            $filteredValues = array_filter($nilai, fn ($item) => $item['kategori_id'] == $category['id']);
            $columnValues = array_sum(array_map(fn ($item) => pow($item['normalisasi'] - $category['avg'], 2), $filteredValues));

            return array_merge($category, ['variasi' => number_format($columnValues, 4)]);
        }, $categories);

        // step 6 mencari penyimpangan variasi preferensi
        $penyimpangan = array_map(fn ($category) => 1 - $category['variasi'], $categories);
        $totalPenympangan = array_sum($penyimpangan);

        // step 7 mencari bobot

        foreach ($categories as $key => $category) {
            foreach ($penyimpangan as $kunci => $p) {
                $categories[$key]['bobot'] = number_format($penyimpangan[$key] / $totalPenympangan, 4);
            }
        }

        // step 8 mencari nilai psi

        $siswa = array_map(function ($siswa) use ($nilai, $categories) {
            $filteredValues = array_filter($nilai, fn ($item) => $item['siswa_id'] == $siswa['id']);
            $psi = array_map(function ($category) use ($filteredValues) {
                $filteredValues = array_filter($filteredValues, fn ($item) => $item['kategori_id'] == $category['id']);
                return array_sum(array_map(fn ($item) => number_format($item['normalisasi'] * $category['bobot'], 4), $filteredValues));
            }, $categories);

            return array_merge($siswa, ['psi' => $psi]);
        }, $siswa);

        $siswa = array_map(fn ($siswa) => array_merge($siswa, ['psi_total' => number_format(array_sum($siswa['psi']), 2)]), $siswa);

        usort($siswa, function ($a, $b) {
            return $b['psi_total'] <=> $a['psi_total'];
        });

        $hasilData = [
            'title' => 'Hasil Penghitungan PSI',
            'data' => $siswa,
            'kategori' => $categories,
        ];

        return view('Operator/viewHasil', $hasilData);
    }

    public function viewSiswa()
    {
        helper('form');

        $model = new ModelOperator();

        $categories = $model->showDataCat()->getResultArray();
        $siswa = $model->showDataNilaiSiswa()->getResultArray();
        $tableData = [];
        foreach ($siswa as $key => $entry) {

            // make entry group by name
            if (!isset($tableData[$entry['id']])) {
                $tableData[$entry['id']] = [
                    'id' => $entry['id'],
                    'name' => $entry['name'],
                    'meta' => [],
                ];
            }

            // add entry to meta
            $tableData[$entry['id']]['meta'][] = [
                'nilai' => $entry['nilai'],
                'kategori_id' => $entry['kategori_id'],
            ];
        }
        $hasilData = [
            'title' => 'Daftar Siswa Peserta Seleksi LKS',
            'data' =>  $tableData,
            'kategori' => $categories,
        ];

        return view('Operator/viewSiswa', $hasilData);
    }

    public function addSiswa()
    {
        helper('form');
        $model = new ModelOperator();
        $nama = [
            'name' => $this->request->getPost('name'),
        ];
        $model->addSiswaData($nama);
        $this->addSiswaAdditionalData();

        return redirect()->to('siswa');
    }

    public function addSiswaAdditionalData()
    {
        $model = new ModelOperator();
        $cat = $model->showDataCat()->getResultArray();
        $latestSiswaId = $model->getLatestSiswaId();
        foreach ($cat as $key => $value) {
            $data = [
                'kategori_id' => $value['id'],
                'siswa_id' => $latestSiswaId,
                'nilai' => $this->request->getPost('nilai' . $value['id']) ?: '1',
            ];
            // dd($data);
            $model->addSiswaAdditionalData($data);
        }
    }

    public function updateSiswa()
    {
        helper('form');
        $model = new ModelOperator();
        $cat = $model->showDataCat()->getResultArray();
        $nilai = $model->showData()->getResultArray();
        $id = $this->request->getPost('id');

        foreach ($cat as $key => $value) {
            $nilaiInput = $this->request->getPost('nilai' . $value['id']);
            $data = [
                'kategori_id' => $value['id'],
                'siswa_id' => $this->request->getPost('id'),
                'nilai' => $nilaiInput ?: '1',
            ];
            $model->updateSiswaData($data);
        }
        return redirect()->to('siswa');
    }

    public function deleteSiswa()
    {
        $model = new ModelOperator();
        $id = $this->request->getPost('id');
        $model->deleteSiswaData($id);
        return redirect()->to('siswa');
    }


    public function viewKategori()
    {
        helper('form');
        $model = new ModelOperator();
        $category = $model->showDataCat()->getResultArray();
        $data = [
            'title' => 'Kriteria Penilaian LKS',
            'kategori' => $category,
        ];
        return view('Operator/viewKategori', $data);
    }

    public function addKategori()
    {
        helper('form');
        $model = new ModelOperator();
        if ($this->request->getPost('type') == 'max') {
            $type = 'max';
        } else {
            $type = 'min';
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'type' => $type,
        ];
        $model->addCategoryData($data);
        return redirect()->to('kategori');
    }

    public function updateKategori()
    {
        helper('form');
        $model = new ModelOperator();
        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $model->updateCategoryData($data, $data['id']);
        return redirect()->to('kategori');
    }

    public function deleteKategori()
    {
        $model = new ModelOperator();
        $id = $this->request->getPost('id');
        $model->deleteCategoryData($id);
        return redirect()->to('kategori');
    }

    public function addData()
    {
        helper('form');
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

    public function viewDetailhasil()
    {
        $model = new ModelOperator();
        $id = $this->request->getPost('siswa');
        $data = $model->showDetailData($id)->getResultArray();
        $kategori = $model->showDataCat()->getResultArray();
        $hasilData = [
            'title' => 'Detail Hasil Penghitungan PSI',
            'data' => $data,
            'kategori' => $kategori,
        ];
        return view('Operator/viewDetailHasil', $hasilData);
    }

    public function getNilaiSiswa($id)
    {
        $model = new ModelOperator();
        $data = $model->showSingleDataNilaiSiswa($id)->getResultArray();
        return json_encode($data);
    }
}
