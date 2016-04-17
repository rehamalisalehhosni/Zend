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
/*                $user = new Application_Form_User($form->getValues());
*/             /*  $this->model->addUser($data);*/
                return $this->_helper->redirector('index');
            }
        } 
        $this->view->form = $form;

    }

    public function loginAction()
    {
        // action body
                $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {

        $request = $this->getRequest();
        $form   = new Application_Form_Login();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
            	$username= $this->_request->getParam('user_email');
				$password= $this->_request->getParam('user_password');
				// get the default db adapter
				$db =Zend_Db_Table::getDefaultAdapter();
				//create the auth adapter
				$authAdapter = new 	Zend_Auth_Adapter_DbTable($db,'users','user_email', 'user_password');
				$authAdapter->setIdentity($username);
				$authAdapter->setCredential(md5($password));
				$result = $authAdapter->authenticate();
				if ($result->isValid()) {
					$auth =Zend_Auth::getInstance();
					$storage = $auth->getStorage();
					$storage->write($authAdapter->getResultRowObject(array('email
' , 'id' , 'user_name','user_email','image')));
                 //$this->_helper->FlashMessenger('Successful Login');
	                return $this->_redirect('/users');
				}else{
				  return $this->_redirect('index');
				}
			}
	    } 
        $this->view->form = $form;
        }else{
            $identity = $auth->getIdentity();
            var_dump($auth->getIdentity()->user_name);
           return $this->_helper->redirector('index');
        }



    }


}





