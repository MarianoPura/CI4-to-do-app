<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;

class UsersController extends BaseController
{
    public function login()
    {
        if ($this->request->isAJAX()){
            $user = model (Users::class);
            $credential = $this->request->getJSON(true);

            $email = $credential['email'];
            $password = $credential['password'];

            $userLogin = $user->where('email', $email)->first();
            if ($userLogin){
                $verified = password_verify($password, $userLogin['password']);
                if ($verified){
                    $this->setUserSession($userLogin);
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Login successful',
                        'redirect' => base_url('to-do')
                    ]);
                }
            }
        }
    }


    private function setUserSession($userLogin){
        $data = [
            'id' => $userLogin['id'],
            'name' => $userLogin['name'],
            'email' => $userLogin['email'],
            'loggedIn' => true
        ];
        session()->set($data);
        return true;
    }


    public function register(){
        if ($this->request->isAJAX()){
            helper (['form']);
            $user = model (Users::class);
            $credential = $this->request->getJSON(true);

            if(!$this->validateData($credential,[
                'name' => 'required|min_length[3]|max_length[250]',
                'email' => 'required|is_unique[users.email]|min_length[10]|max_length[150]',
                'password' => 'required|min_length[1]|max_length[50]',
                'confirm' => 'required|matches[password]'
            ],
             ['email' => ['is_unique' => 'asdkjasdhsahj']]
            )) {
                return $this->response->setJSON(['success' => false, 'message' => $this->validator->getErrors()]);
            }

            $registered = $this->validator->getValidated();
            $user->save([
                'name' => $registered['name'],
                'email' => $registered['email'],
                'password' => password_hash ($registered['password'], PASSWORD_DEFAULT)
            ]);

            return $this->response->setJSON(['success' => true, 'message' => 'Registration complete', 'redirect' => base_url('loginPage')]);
        }
    }

    public function logout(){
        $loggedIn = session()->get('loggedIn');
        if(!$loggedIn){
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You are not logged in',
                'redirect' => base_url('loginPage')
            ]);
        }

        session()->destroy();
        return $this->response->setJSON(['success' => true, 'message' => 'Account signed out', 'redirect' => base_url('loginPage')]);
    }

    public function AccountSettings(){
        $id = session()->get('id');
        if($this->request->isAJAX()){
            $model = model(Users::class);
            $data = $model->find($id);
            return $this->response->setJSON([$data]);
        }
    }

    public function accountUpdate (){
        $id = session()->get('id');

        helper(['form']);
        $post = $this->request->getJSON(true);
        if(!$this->validateData($post,[
            'name' => 'required|min_length[3]|max_length[250]',
            'email' => 'required|is_unique[users.email]|min_length[10]|max_length[150]',
            'password' => 'required|min_length[1]|max_length[50]',
            'confirm' => 'required|matches[password]'
        ])){
            return $this->response->setJSON(['success' => false, 'message' => 'Account update failed']);
        }
        $validated = $this->validator->getValidated();
        $model = model(Users::class);
        $model->update($id, [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => password_hash ($validated['password'], PASSWORD_DEFAULT)
        ]);
            return $this->response->setJSON(['success' => true, 'message' => 'Account update successful!', 'redirect' => base_url('to-do')]);

    }

    public function loginPage(){
        return view('login/login');
    }

    public function registrationPage(){
        return view('login/registration');
    }
}
