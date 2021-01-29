<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    
     public function search()
    {

        $this->request->allowMethod('ajax');
   
        $keyword = $this->request->query('keyword');

        $query = $this->Employees->find('all',[
              'conditions' => ['Employees.id LIKE'=>$keyword],
              'order' => ['Employees.id'=>'DESC'],
              'limit' => 10
        ]);

        $this->set('employees', $this->paginate($query));
        $this->set('_serialize', ['Employees']);

    }
    
    public function index()
    {
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);

        $this->set('employee', $employee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
               $postData = $this->request->getData(); 

            
             if(isset($postData["employee_image"])){
          
                 $target_path = WWW_ROOT . 'img/';
                 print_r($target_path);
         
            $new_file_name = "employee_image" . time() . "." . "jpg";
            $path = $new_file_name;
                             print_r($path);

            $to_path = $target_path . $new_file_name; //set the target path with a new name of image
//            echo $to_path;

     if ($new_file_name != '') {
               
                if (move_uploaded_file($_FILES['employee_image']['tmp_name'],$to_path)) {
//                    echo 'ehrgjergh';
                    $postData["employee_image"]= Router::url('/', true)."img/".$new_file_name;
                } else {
//                    echo "Error in photo";
                }
            }
                
            }
           $employee = $this->Employees->patchEntity($employee,$postData);
 
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
