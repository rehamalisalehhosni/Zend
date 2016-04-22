<?php

class UsersController extends Zend_Controller_Action
{
    protected $auth;

    public function init()
    {
        /* Initialize action controller here */
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
                $identity = $this->auth->getIdentity();
                $this->view->user_name = $this->auth->getIdentity()->user_name;
                $this->view->user_email= $this->auth->getIdentity()->user_email;
                $this->view->user_type = $this->auth->getIdentity()->user_type;
                $this->view->image = $auth->getIdentity()->image;
                // Identity exists; get it
        }else{
                $users = new Application_Model_DbTable_Users();
                $form2 = new Application_Form_Login();
                $this->view->form2 = $form2;

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
        $form->removeElement('ban');
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) { 
                $data = $this->getRequest()->getParams(); 

                if (!$form->image->receive()) {
                        print "Upload error";
                  }

                 //change image   name
                $data['image']=$form->image->getValue('name');
                $data['registration_date']=date('Y-m-d');
                $data['last_login_date']=date('Y-m-d');
                $data['user_type']="user";
                $data['ban']=0;

/*                $form->getValues()['registration_date']=date('Y-m-d');
*/              $users = new Application_Model_Users($data);
                $mapper = new Application_Model_UsersMapper();
                if($mapper->userExists($data['user_email'])){

                   return $this->view->error="user already exists";    
                }else{
                    $mapper->save($users);
                    return $this->_helper->redirector('index');    
                    
                }

            }
        } 
        $this->view->form = $form;

    }

    public function listAction()
    {
      if($this->auth->getIdentity()->user_type=="admin"){
            $mapper = new Application_Model_UsersMapper();
            $this->view->users = $mapper->fetchAll();
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        }        

        // action body
    }

    public function editUserAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');      
        if($this->auth->getIdentity()->user_type=="admin"|| $this->auth->getIdentity()->user_id==$id ){
            $request = $this->getRequest();
            $form = new Application_Form_Signup();
            if($this->auth->getIdentity()->user_type=="user"){
                $form->removeElement('ban');
                
            }

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
                if($this->auth->getIdentity()->user_type=="user"){
                    $data['ban']="0";
                
                }

                   $data['image']=$form->image->getValue('name');
                    $data = $this->getRequest()->getParams();
                     if(empty($data['user_password'])) {
                        $data['user_password']=$user['user_password'];
                     }else{
                        $data['user_password']=md5($data['user_password']);
                    } 
/*                    $data['user_password']=md5($data['user_password']);
*/                    $data['image']=$form->image->getValue('name');
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
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        }        
    }

    public function deleteUserAction()
    {
        // action body
        if($this->auth->getIdentity()->user_type=="admin" ){
   
        $users = new Application_Model_Users();
        $mapper = new Application_Model_UsersMapper();
        $id = $this->getRequest()->getParam('id');  
        $user=$mapper->remove($id);
        return $this->_helper->redirector('index'); //idont know helper
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        } 

    }

}













