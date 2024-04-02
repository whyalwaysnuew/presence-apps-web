<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PresenceModel;

class Presence extends BaseController
{
    public function __construct()
    {
        $apikey = '4c0ed84dccb244e39c07faf0e5b5593f';
        $this->geocoder = new \OpenCage\Geocoder\Geocoder($apikey);
        $this->presence = new PresenceModel;
    }

    public function index()
    {
        $data = [
            'title' => 'Presence | PT SILICAINDO ',
            'menu' => 'Presence',
            'ajax' => 'presence'
        ];

        return view('presence/index', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $presence_id = $this->presence->generateId();

        if(@$data)
        {
            $value = [
                'presence_id' => $presence_id,
                'file' => $data['pictureFileName'],
                'name' => trim($data['name']),
                'remark' => trim($data['remark']),
                'presence_date' => date('y:m:d H:i:s', strtotime($data['date'])),
                'location' => trim($data['location']),
                'created_by' => $data['created_by'],
                'created_at' => date('y:m:d h:i:s')
            ];
    
            $result = $this->presence->store($value);
    
            if(@$result)
            {
                $data = [
                    'response' => 200,
                    'message' => 'Presence sucessfully submitted!'
                ];
            } else {
                $data = [
                    'response' => 400,
                    'message' => 'An error occured!'
                ];
            }
        } else {
            $data = [
                'response' => 500,
                'message' => 'Something went wrong! Please try again.'
            ];
        }
        

        echo json_encode($data);
    }

    public function getReverseLocation()
    {
        $latitude = $this->request->getGet('latitude');
        $longitude = $this->request->getGet('longitude');
        $result = $this->geocoder->geocode($latitude.','.$longitude);

        $data = [
            'response' => 200,
            'place' => $result['results'][0]['formatted'],
            // 'latlng' => 'Latitude: ' . $latitude . ' - Longitude:' . $longitude 
        ];

        echo json_encode($data);
    }

    public function uploadFile()
    {
        @set_time_limit(900);

        header('Content-Type: application/json');
        $file = $this->request->getFile('file');
        $user_id = $this->request->getPost('user_id');

        $file_mut_name = "PICT".$file->getRandomName();

        if(is_dir('../public/upload/presence/' . $user_id . '/') == false)
        {
            mkdir('../public/upload/presence/' . $user_id . '/');
            chmod('../public/upload/presence/' . $user_id . '/', 0777);
        }

        $file->move('../public/upload/presence/' . $user_id . '/', $file_mut_name);

        $data = [
            'response' => 200,
            'message' => 'File Uploaded',
            'file' => $file_mut_name
        ];

        echo json_encode($data);
    }

    public function removeFile()
    {
        @set_time_limit(900);

        header('Content-Type: application/json');
        $file = $this->request->getFile('file');
        $user_id = $this->request->getPost('user_id');
        $pictureName = $this->request->getPost('pictureName');

        if(@$pictureName)
        {
            if(file_exists('./upload/presence/' . $user_id . '/' . $pictureName)){
                unlink('./upload/presence/' . $user_id . '/' . $pictureName);
            }
        }

        $data = [
            'response' => 200,
            'message' => 'File Removed'
        ];

        echo json_encode($data);
    }

    public function history()
    {
        $presence = $this->presence->getPresenceData();

        $data = [
            'title' => 'Presence History | PT SILICAINDO',
            'presence' => $presence,
            'menu' => 'History'
        ];

        return view('presence/history', $data);
    }
}
