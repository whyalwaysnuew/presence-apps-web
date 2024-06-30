<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct() {
        $this->user = new UserModel();
    }

    public function index()
    {
        $users = $this->user->getData();

        $data = [
            'title' => 'User | PT SILICAINDO',
            'menu' => 'User',
            'ajax' => 'user',
            'users' => $users
        ];

        return view('user/index', $data);
    }
    
    public function edit($id)
    {
        $user = $this->user->getDetail($id);
        $divisions = $this->user->getDivision();

        $data = [
            'title' => 'Edit User | PT SILICAINDO',
            'menu' => 'User',
            'ajax' => 'user',
            'user' => @$user,
            'divisions' => $divisions
        ];

        return view('user/edit', $data);
    }

    public function update()
    {

    }

    public function delete()
    {
        $id = $this->request->getGet('id');

        if(@$id)
        {
            try {
                $this->user->deleteData($id);

                $result = [
                    'response' => 200,
                    'message' => 'User has been deleted from server'
                ];
            } catch (\Exception $e) {
                $result = [
                    'response' => 400,
                    'message' => $e->getMessage()
                ];
            }
        } else {
            $result = [
                'response' => 500,
                'message' => 'Unexpected Error. Please try again!'
            ];
        }

        return $this->response->setJSON($result);
    }
}
