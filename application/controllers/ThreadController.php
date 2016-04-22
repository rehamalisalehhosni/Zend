<?php

class ThreadController extends Zend_Controller_Action
{

    protected $auth = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth ->hasIdentity()) {
                $identity =  $this->auth->getIdentity();
                $this->view->user_name =  $this->auth->getIdentity()->user_name;
                $this->view->user_email =  $this->auth->getIdentity()->user_email;
                // Identity exists; get it
        }else{
                $users = new Application_Model_DbTable_Users();
                $form2 = new Application_Form_Login();
                $this->view->form2 = $form2;

        }
        ///stoped loggin
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
                $data['owner_id']=$this->auth ->getIdentity()->user_id;//from user session
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
       $thread = new Application_Model_Thread();
        $mapper = new Application_Model_ThreadMapper();
        $id = $this->getRequest()->getParam('id'); 
        $thread=$mapper->remove($id);
        return $this->_helper->redirector('delete');
    }

    public function editAction()
    {
        // action body
        $request = $this->getRequest();
        $id = $this->getRequest()->getParam('id');      
        $form = new Application_Form_AddThread();
        $mapper = new Application_Model_ThreadMapper();
        $thread=$mapper->find_array($id)[0];
/*        $this->view->image=$data['image'];
*/      $form->populate($thread);
        #$form->getElement('user_password')->setRequired(false);
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {    
                $data = $this->getRequest()->getParams();
                $thread = new Application_Model_Thread($data);
                $mapper = new Application_Model_ThreadMapper();
                $thread->setThread_id($id);
                $mapper->save($thread);
               // return $this->_helper->redirector('index'); //idont know helper
            }
        }         
        $this->view->form = $form;   

    }

    public function listAction()
    {
        // action body
        $mapper = new Application_Model_ThreadMapper();
        $this->view->threads = $mapper->fetchAll();
    }

    public function threadAction()
    {
        // action body
        //single page thread
      $id = $this->getRequest()->getParam('id'); 
        $mapper = new Application_Model_ThreadMapper();
        $this->view->thread = $mapper->getThread($id);
        //$this->view->replay = $mapper->getReply($id);

    }

    public function threadCategoryAction()
    {
      $id = $this->getRequest()->getParam('id'); 
      $mapper = new Application_Model_ThreadMapper();
      $this->view->threads = $mapper->getThread_category($id);   
      $cat = new Application_Model_CategoryMapper();
      $this->view->cat = $cat->find($id);
      $this->view->Parcat = $cat->find($this->view->cat->getCategory_parent());
        // action body

    }


}













