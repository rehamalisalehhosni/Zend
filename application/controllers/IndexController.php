<?php

class IndexController extends Zend_Controller_Action
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
        }else{
                $users = new Application_Model_DbTable_Users();
                $form2 = new Application_Form_Login();
                $this->view->form2 = $form2;

        }

    }

    public function indexAction()
    {
        // action body
        $mapper = new Application_Model_CategoryMapper();
        $this->view->cats = $mapper;
        $mapperthraed = new Application_Model_ThreadMapper();
        $this->view->thread = $mapperthraed;


    }


}

