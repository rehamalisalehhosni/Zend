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
        }

    }

    public function indexAction()
    {
        // action body
    }


}

