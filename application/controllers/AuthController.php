<?php

class AuthController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
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
    }
    public function logoutAction()
    {
        // action body
            $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->_redirect('index/index');
    }
}
