<?php

namespace App\Controllers;

use App\Models\ModelAuth;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        helper('form');
        if (session('logged_in')) {
            return redirect()->to(site_url('operator'));
        };
        $data = [
            'pageTitle' => 'Login',
        ];
        return view('Auth/viewLogin', $data);
    }

    public function loginProcess()
    {

        helper('form');
        $login = new ModelAuth();
        $post = $this->request->getPost();
        $user = $login->loginProcess($post['username']);
        if ($user) {
            if ($post['password'] == $user->password) {
                $data = [
                    'nama' => $user->nama,
                    'logged_in' => true,
                    'login_time' => date("h:i"),
                    'authority' => $user->authority,
                ];
                session()->set($data);
                return redirect()->to(site_url('hasil'));
            } else {
                return redirect()->back()->with('error', 'Password Salah');
            }
        };
        return redirect()->back()->with('error', 'Username tidak ditemukan');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('home'));
    }
}
