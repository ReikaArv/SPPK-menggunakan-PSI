<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Landing extends Controller
{
    public function index()
    {
        // Load the view file
        return view('landing/viewLanding');
    }
}
