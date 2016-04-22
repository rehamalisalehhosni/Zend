<?php

class ThreadReplyController extends Zend_Controller_Action
{
  protected $auth;
   public function init()
   {
       /* Initialize action controller here */
       $this->auth = Zend_Auth::getInstance();
       if ($this->auth ->hasIdentity()) {
               $identity =  $this->auth->getIdentity();
               $this->view->user_name =  $this->auth->getIdentity()->user_name;
               $this->view->user_email =  $this->auth->getIdentity()->user_email;
               // Identity exists; get it
       }else{
               $users = new Application_Model_DbTable_Users();
               $form2 = new Application_Form_Login();
               $this->view->form2 = $form2;

       }
       ///stoped loggin
   }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_AddReply();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {

                $data = $this->getRequest()->getParams();
                $data['date']=date('Y-m-d');
                $data['thread_id']=1; //from category session
                $data['owner_id']=$this->auth ->getIdentity()->user_id;//from user session
                $reply = new Application_Model_ThreadReply($data);
                $mapper = new Application_Model_ThreadReplyMapper();
                $mapper->save($reply);
                return $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        // action body
         $reply = new Application_Model_ThreadReply();
         $mapper = new Application_Model_ThreadReplyMapper();
         $id = $this->getRequest()->getParam('id');
         $reply=$mapper->remove($id);
         return $this->_helper->redirector('delete');
    }

    public function editAction()
    {
        // action body
        $request = $this->getRequest();
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_AddReply();
        $mapper = new Application_Model_ThreadReplyMapper();
        $reply=$mapper->find_array($id)[0];

        $form->populate($reply);
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $data = $this->getRequest()->getParams();
                $thread = new Application_Model_Thread($data);
                $mapper = new Application_Model_ThreadMapper();
                $thread->setThread_id($id);
                $mapper->save($thread);
            }
        }
        $this->view->form = $form;
    }

    public function listAction()
    {
        // action body
        $mapper = new Application_Model_ThreadReplyMapper();
        $this->view->replies = $mapper->fetchAll();
    }


}
