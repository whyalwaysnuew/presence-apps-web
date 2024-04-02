<<<<<<< HEAD
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->auth = new AuthModel;

    }
    
    public function index()
    {
        if(session()->get('user_id')){
            return redirect()->to(base_url('/'));
        }


        $data = [
            'title' => 'Auth | PT SILICAINDO',
            'ajax' => 'auth',
            'divisions' => $this->auth->getDivision()
        ];

        return view('auth/index', $data);
    }

    public function login()
    {
        $data = $this->request->getPost();

        // $user = $this->auth->where('username', $data['username'])->first();
        $user = $this->auth->getDataUser($data['username']);

        if($user && password_verify($data['password'], $user->password))
        {
            // $userData = [
            //     'user_id' => $user['user_id'],
            //     'username' => $user['username'],
            //     'level' => $user['level'],
            //     'fullname' => $user['fullname'],
            //     'status' => $user['status'],
            // ];

            $userData = [
                'user_id' => $user->user_id,
                'username' => $user->username,
                'level' => $user->level,
                'fullname' => $user->fullname,
                'status' => $user->status,
                'division' => $user->division,
                'division_name' => $user->division_name
            ];

            session()->set($userData);

            $data = [
                'response' => 200,
                'message' => 'Login Success!'
            ];

        } else {
            $data = [
                'response' => 500,
                'message' => 'Account doesn\'t match any data!'
            ];
        }

        echo json_encode($data);

    }

    public function register()
    {
        $data = $this->request->getPost();

        $emailChecked = $this->auth->checkEmail($data['email']);
        $usernameChecked = $this->auth->checkUsername($data['username']);

        if(@$data){
            if($data['password'] != $data['password_2'])
            {
                $data = [
                    'response' => 400,
                    'message' => 'Confirmed Password doesn\'t match!'
                ];
            } else {
                if(@$usernameChecked)
                {
                    if(@$emailChecked)
                    {
                        $user_id = $this->auth->generateId();
                        $data = [
                            'user_id' => $user_id,
                            'username' => $data['username'],
                            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                            'fullname' => $data['fullname'],
                            'email' => $data['email'],
                            'division' => $data['division'],
                            'level' => 'USER',
                            'status' => 0,
                        ];
        
                        $result = $this->auth->register($data);
        
                        if($result){
                            $data = [
                                'response' => 200,
                                'message' => 'Account Has Been Registered!'
                            ];
                        } else {
                            $data =[
                                'response' => 500,
                                'message' => 'Something went wrong! Please register again.'
                            ];
                        }
                    } else {
                        $data = [
                            'response' => 400,
                            'message' => 'Email has been registered!'
                        ];
                    }
                } else {
                    $data = [
                            'response' => 400,
                            'message' => 'Username has been registered!'
                        ];
                }
            }
        } else {
            $data = [
                'response' => 500,
                'message' => 'Something went wrong! Please try again.'
            ];
        }

        echo json_encode($data);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(base_url('auth'));
    }

    public function isLogin()
    {

    }
}
=======
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->auth = new AuthModel;

    }
    
    public function index()
    {
        if(session()->get('user_id')){
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Auth | PT SILICAINDO',
            'ajax' => 'auth',
        ];

        return view('auth/index', $data);
    }

    public function login()
    {
        $data = $this->request->getPost();

        $user = $this->auth->where('username', $data['username'])->first();

        if($user && password_verify($data['password'], $user['password']))
        {
            $userData = [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'level' => $user['level'],
                'fullname' => $user['fullname'],
                'status' => $user['status']
            ];

            session()->set($userData);

            $data = [
                'response' => 200,
                'message' => 'Login Success!'
            ];

        } else {
            $data = [
                'response' => 500,
                'message' => 'Account doesn\'t match any data!'
            ];
        }

        echo json_encode($data);

    }

    public function register()
    {
        $data = $this->request->getPost();

        $emailChecked = $this->auth->checkEmail($data['email']);
        $usernameChecked = $this->auth->checkUsername($data['username']);

        if(@$data){
            if($data['password'] != $data['password_2'])
            {
                $data = [
                    'response' => 400,
                    'message' => 'Confirmed Password doesn\'t match!'
                ];
            } else {
                if(@$usernameChecked)
                {
                    if(@$emailChecked)
                    {
                        $user_id = $this->auth->generateId();
                        $data = [
                            'user_id' => $user_id,
                            'username' => $data['username'],
                            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                            'fullname' => $data['fullname'],
                            'email' => $data['email'],
                            'level' => 'USER',
                            'status' => 0,
                        ];
        
                        $result = $this->auth->register($data);
        
                        if($result){
                            $data = [
                                'response' => 200,
                                'message' => 'Account Has Been Registered!'
                            ];
                        } else {
                            $data =[
                                'response' => 500,
                                'message' => 'Something went wrong! Please register again.'
                            ];
                        }
                    } else {
                        $data = [
                            'response' => 400,
                            'message' => 'Email has been registered!'
                        ];
                    }
                } else {
                    $data = [
                            'response' => 400,
                            'message' => 'Username has been registered!'
                        ];
                }
            }
        } else {
            $data = [
                'response' => 500,
                'message' => 'Something went wrong! Please try again.'
            ];
        }

        echo json_encode($data);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(base_url('auth'));
    }

    public function isLogin()
    {

    }
}
>>>>>>> 2800c1c (test)
