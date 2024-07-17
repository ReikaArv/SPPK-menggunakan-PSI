<?php

namespace App\Controllers;

use App\Models\ModelSuperadmin;
use CodeIgniter\Controller;

class Superadmin extends Controller
{
    public function index()
    {
        helper('form');
        $model = new ModelSuperadmin();
        $users = $model->getAllAccounts()->getResultArray();
        $data = [
            'title' => 'Kelola Akun',
            'users' => $users,
        ];
        // return view('Operator/viewKategori', $data);
        return view('Superadmin/viewUser', $data);
    }

    public function addAdmin()
    {
        helper('form');
        $model = new ModelSuperadmin();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama' => $this->request->getPost('nama'),
            'authority' => 1,
        ];
        $model->addAdmin($data);
        return redirect()->to('superadmin');
    }

    public function deleteAdmin()
    {
        helper('form');
        $model = new ModelSuperadmin();
        $id = $this->request->getPost('id');
        $model->deleteAdmin($id);
        return redirect()->to('superadmin');
    }
}
