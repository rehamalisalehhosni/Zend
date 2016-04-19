<?php

class ThreadController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_AddThread();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
 
                $data = $this->getRequest()->getParams();
                $data['date']=date('Y-m-d');
                $data['thread_state_id']=1; //active thread non-blocked
$data['category_id']=1; //from category session
$data['owner_id']=1;//from user session
/*                $form->getValues()['registration_date']=date('Y-m-d');
*/              $thread = new Application_Model_Thread($data);
                $mapper = new Application_Model_ThreadMapper();
                $mapper->save($thread);

                return $this->_helper->redirector('index');    
            }
        } 
        $this->view->form = $form;

    }

    public function deleteAction()
    {
        // action body
      /*  $thread = new Application_Model_Thread();
        $mapper = new Application_Model_ThreadMapper();
        $id = $this->getRequest()->getParam('thread_id');  
        $thread=$mapper->remove($id);
        return $this->_helper->redirector('delete');*/
    }

    public function editAction()
    {
        // action body

    }

    public function listAction()
    {
        // action body
        $mapper = new Application_Model_ThreadMapper();
        $this->view->threads = $mapper->fetchAll();
    }


}









