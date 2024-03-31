<?php

namespace App\Controllers;
use App\Models\HomeModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->home = new HomeModel;
    }

    public function index(): string
    {
        
        $data = [
            'title' => 'Dashboard | PT SILICAINDO',
            'menu' => 'Home',
            'division' => $this->home->getTotalDivision(),
            'employee' => $this->home->getTotalEmployee(),
            'presence' => $this->home->getTotalPresence()
        ];

        return view('home/index', $data);
    }
}
