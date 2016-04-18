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
        $user=$mapper->find_array($id)[0];
/*        $this->view->image=$data['image'];
*/      $form->populate($user);
        $form->getElement('user_password')->setRequired(false);
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                    if (!$form->image->receive()) {
                        print "Upload error";
                           //$data['image']=$user['image'];
                      }
                      $data['image']=$form->image->getValue('name');
              /*   if(!$form->user_password){
                    $data['user_password']=md5($data['user_password']);
                 }else{
                    $data['user_password']=md5($user['user_password']);
                } */
                $data = $this->getRequest()->getParams();
                $data['user_password']=md5($data['user_password']);
                $data['image']=$form->image->getValue('name');
                $data['registration_date']=$user['registration_date'];
                $data['last_login_date']=$user['last_login_date'];
                $data['user_type']=$user['user_type'];
                $users = new Application_Model_Users($data);
                $mapper = new Application_Model_UsersMapper();
                $users->setUser_id($id);
                $mapper->save($users);
                return $this->_helper->redirector('index'); //idont know helper
            }
        }         
        $this->view->form = $form;         
    }

    public function deleteUserAction()
    {
        // action body
   
        $users = new Application_Model_Users();
        $mapper = new Application_Model_UsersMapper();
        $id = $this->getRequest()->getParam('id');  
        $user=$mapper->remove($id);
        return $this->_helper->redirector('index'); //idont know helper

    }

}













