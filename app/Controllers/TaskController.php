<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Tasks;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Database;

class TaskController extends BaseController
{
    public function index()
    {
        $user_id = session()->get('id');
        if ($this->request->isAJAX()){
            $model = model(Tasks::class);
            $data = $model->where('user_id', $user_id)->findAll();
            return $this->response->setJSON(['success' => 'true', 'tasks' => $data]);
        }
        return view('to-do-app/to-do-app');
    }

    public function create(){
        helper (['form']);
        $user_id = session()->get('id');
        $model = model(Tasks::class);

        $data = $this->request->getPost(['task']);

        if(!$this->validateData($data,[
            'task' => 'required|min_length[1]|max_length[50]'
        ]));
        try{
        $post = $this->validator->getValidated();
        $model->save([
            'task' => $post['task'],
            'status' => 'incomplete',
            'user_id' => $user_id
        ]); 
        return redirect()->to('to-do')->with('success', 'New task was added to the list');
        }
        catch(DatabaseException $e){
            $db = Database::connect();
            $errorcode = $db->error();
            if (!empty($errorcode['code'])){
                if($errorcode['code'] === 1062){
                    return redirect()->to('to-do')->with('failed', 'This task already exist from your list');
                }
                else{
                    return redirect()->to('to-do')->with('failed', $errorcode['message']);
                }
            }
        }

       
    }

    public function delete($id = null){
        $model = model(Tasks::class);
        $delete = $model->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Task has been removed'
            ]);
        }
        else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Task does not exist'
            ]);
        }
    }


    public function update($id = null){
        if ($this->request->isAJAX()){
        helper(['form']);
        $model = model(Tasks::class);
        $data = $model->find($id);
        if($data['task'] == null){
            throw new PageNotFoundException('No task found with id: ', $id);
        }

        if ($data['status'] == 'incomplete'){
            $model->update($id,[
                'status' => 'complete'
            ]);
            return $this->response->setJSON(['updated' => true]);
        }

        else{
            $model->update($id,[
                'status' => 'incomplete'
            ]);
            return $this->response->setJSON(['updated' => true]);
            }
            
        }
        return $this->response->setJSON(['updated' => false]);
    }
}
