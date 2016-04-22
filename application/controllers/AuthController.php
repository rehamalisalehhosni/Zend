<?php

class AuthController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
                $identity = $auth->getIdentity();
                $this->view->user_name = $auth->getIdentity()->user_name;
                $this->view->user_email = $auth->getIdentity()->user_email;
                $this->view->user_type = $auth->getIdentity()->user_type;
                // Identity exists; get it
        }else{
                $users = new Application_Model_DbTable_Users();
                $form2 = new Application_Form_Login();
                $this->view->form2 = $form2;

        }
    }

    public function indexAction()
    {
        // action body
         return $this->_redirect('/index/index');

    }

    public function loginAction()
    {
      $auth = Zend_Auth::getInstance();
      if (!$auth->hasIdentity()) {
        $users = new Application_Model_DbTable_Users();
        $form = new Application_Form_Login();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                $data = $form->getValues();
                $auth = Zend_Auth::getInstance();
    /*                $db =Zend_Db_Table::getDefaultAdapter();
    */               $authAdapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(), 'Users');
                    //create the auth adapter
                    $authAdapter->setIdentityColumn('user_email')->setCredentialColumn('user_password');
                $authAdapter->setIdentity($data['email'])->setCredential(md5($data['password']));
                $result = $auth->authenticate($authAdapter);
                if ($result->isValid()) {
                    $storage = new Zend_Auth_Storage_Session();
                    $storage->write($authAdapter->getResultRowObject());
                    $mysession = new Zend_Session_Namespace('mysession');
                    if (isset($mysession->destination_url)) {
                        $url = $mysession->destination_url;
                        unset($mysession->destination_url);
                        $this->_redirect($url);
                    }
                    $this->_redirect('index/index');
                } else {
                    $this->view->errorMessage = 'Invalid email or password. Please try again.';
                }
            }
        }
      }else{
            $this->_redirect('index/index');
      }
    }
    public function logoutAction()
    {
        // action body
/*        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
*/
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();

        $this->_redirect('index/index');
    }
}
