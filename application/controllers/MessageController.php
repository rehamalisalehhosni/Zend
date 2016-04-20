<?php

class MessageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
           // action body
                // action body
        $form = new Application_Form_Message();
        $request = $this->getRequest();
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
        // action body

    }

    public function editAction()
    {
        // action body
    }


}





