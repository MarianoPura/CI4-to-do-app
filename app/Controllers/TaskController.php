<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Tasks;
use CodeIgniter\Exceptions\PageNotFoundException;

class TaskController extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()){
            $model = model(Tasks::class);
            $data = $model->findAll();
            return $this->response->setJSON(['success' => 'true', 'tasks' => $data]);
        }
        return view('to-do-app/to-do-app');
    }

    public function create(){
        helper (['form']);
        $model = model(Tasks::class);

        $data = $this->request->getPost(['task']);

        if(!$this->validateData($data,[
            'task' => 'required|min_length[1]|max_length[50]'
        ]));

        $post = $this->validator->getValidated();
        $model->save([
            'task' => $post['task']
        ]);
        return redirect()->to('to-do')->with('Success', 'New task was added to the list');
    }

    public function delete($id = null){
        $model = model(Tasks::class);
        $model->delete($id);
        return redirect()->to('to-do')->with('success', 'Task has been removed');
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
            return $this->response->setJSON(['success' => true]);
        }

        else{
            $model->update($id,[
                'status' => 'incomplete'
            ]);
            return $this->response->setJSON(['success' => true]);
            }
            
        }
        return $this->response->setJSON(['success' => false]);
    }

}
