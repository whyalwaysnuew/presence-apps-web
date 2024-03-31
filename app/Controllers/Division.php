<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DivisionModel;

class Division extends BaseController
{
    public function __construct()
    {
        $this->division = new DivisionModel;
    }

    public function index()
    {
        $divisions = $this->division->getDivisionData();

        $data = [
            'title' => 'Division | PT SILICAINDO ',
            'menu' => 'Division',
            'ajax' => 'division',
            'divisions' => $divisions
        ];

        return view('division/index', $data);
    }

    public function create()
    {
        echo view('division/create');
    }

    public function store()
    {
        $post = $this->request->getPost();

        if(@$post)
        {
            $division_id = $this->division->generateId();

            $value = [
                'division_id' => $division_id,
                'division_name' => trim($post['division_name'])
            ];

            $insert = $this->division->store($value);

            if(@$insert)
            {
                $result = [
                    'response' => 200,
                    'message' => 'Division successfully submitted.'
                ];
            } else {
                $result = [
                    'response' => 400,
                    'message' => 'An error occured!'
                ];
            }
        } else {
            $result = [
                'response' => 500,
                'message' => 'Unexpected Error. Please try again.'
            ];
        }

        echo json_encode($result);
    }

    public function edit()
    {
        $id = $this->request->getGet('id');
        $division_name = $this->division->getDivisionById($id)->division_name;

        $data = [
            'id' => $id,
            'division_name' => $division_name
        ];

        echo view('division/edit', $data);
    }

    public function update()
    {
        $post = $this->request->getPost();

        if(@$post)
        {
            $value = [
                'division_name' => $post['division_name']
            ];

            $this->division->updateData($post['division_id'], $value);

            $result = [
                'response' => 200,
                'message' => 'Division has been updated.'
            ];
        } else {
            $result = [
                'response' => 500,
                'message' => 'Unexpected Error. Please try again.'
            ];
        }

        echo json_encode($result);
    }

    public function delete()
    {
        $id = $this->request->getGet('id');

        if(@$id)
        {
            $this->division->deleteData($id);

            $result = [
                'response' => 200,
                'message' => 'Division has been deleted from server.'
            ];
        } else {
            $result = [
                'response' => 500,
                'message' => 'Unexpected Error. Please try again.'
            ];
        }

        echo json_encode($result);
    }
}