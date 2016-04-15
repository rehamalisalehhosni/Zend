<?php

class UsersController extends Zend_Controller_Action
{
    private $model;

    public function init()
    {
        /* Initialize action controller here */
        $this->model=new Application_Model_DbTable_Users();
    }

    public function indexAction()
    {
        // action body
    }

    public function signupAction()
    {
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
*/               $this->model->addUser($data);
                return $this->_helper->redirector('index');
            }
        } 
        $this->view->form = $form;
    }

    public function userProfileAction()
    {
        // action body
    }


}





