<<<<<<< HEAD
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
=======
<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home/index');
    }
}
>>>>>>> 2800c1c (test)
