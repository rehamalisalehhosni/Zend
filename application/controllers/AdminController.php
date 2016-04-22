<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
       $auth = Zend_Auth::getInstance();
      if($auth->getIdentity()->user_type=="admin" ){
            if ($auth->hasIdentity()) {
                    $identity = $auth->getIdentity();
                    $this->view->user_name = $auth->getIdentity()->user_name;
                    $this->view->user_email = $auth->getIdentity()->user_email;
                    $this->view->user_type = $auth->getIdentity()->user_type;
                    $this->view->image = $auth->getIdentity()->image;
                    $this->view->user_id = $auth->getIdentity()->user_id;
                    // Identity exists; get it
            }else{
                    $users = new Application_Model_DbTable_Users();
                    $form2 = new Application_Form_Login();
                    $this->view->form2 = $form2;
            }
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        } 

    }

    public function indexAction()
    {
        // action body
    }


}

