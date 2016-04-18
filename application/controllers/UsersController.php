<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
  		$auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
                $identity = $auth->getIdentity();
                $this->view->user_name = $auth->getIdentity()->user_name;
                $this->view->user_email = $auth->getIdentity()->user_email;
                // Identity exists; get it
        }
        /* Initialize action controller here */
/*        $this->model=new Application_Model_DbTable_Users();
*/
    }

    public function indexAction()
    {
        // action body

    }

    public function signupAction()
    {
        // action body
                // action body
        $form = new Application_Form_Signup();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
            	if (!$form->image->receive()) {
				        print "Upload error";
				  }
				 //change image   name
                $data = $this->getRequest()->getParams();
                $data['image']=$form->image->getValue('name');
                $data['registration_date']=date('Y-m-d');
                $data['last_login_date']=date('Y-m-d');
                $data['user_type']="user";

/*                $form->getValues()['registration_date']=date('Y-m-d');
*/              $users = new Application_Model_Users($data);
                $mapper = new Application_Model_UsersMapper();
                $mapper->save($users);

                return $this->_helper->redirector('index');    
            }
        } 
        $this->view->form = $form;

    }

    public function listAction()
    {
        $mapper = new Application_Model_UsersMapper();
        $this->view->users = $mapper->fetchAll();
        // action body
    }

    public function editUserAction()
    {
        // action body
        $request = $this->getRequest();
        $id = $this->getRequest()->getParam('id');      
        $form = new Application_Form_Signup();
        $mapper = new Application_Model_UsersMapper();
        var_dump($mapper->find($id));
        $form->populate($mapper->find($id));
        $form->getElement('password')->setRequired(false);
        if ($request->isPost()) {

            }
         
        $this->view->form = $form;         

    }

    public function deleteUserAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');      
    }


}













