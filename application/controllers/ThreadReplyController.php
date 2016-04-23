<?php

class ThreadReplyController extends Zend_Controller_Action
{
  protected $auth;
   public function init()
   {
       /* Initialize action controller here */
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
                $identity = $this->auth->getIdentity();
                $this->view->user_name = $this->auth->getIdentity()->user_name;
                $this->view->user_email = $this->auth->getIdentity()->user_email;
                $this->view->user_type = $this->auth->getIdentity()->user_type;
                $this->view->image = $this->auth->getIdentity()->image;
                $this->view->user_id = $this->auth->getIdentity()->user_id;

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
                $data['thread_id']= $this->getRequest()->getParam('id');
                $data['owner_id']=$this->auth ->getIdentity()->user_id;//from user session
                $reply = new Application_Model_ThreadReply($data);
                $mapper = new Application_Model_ThreadReplyMapper();
                $mapper->save($reply);
              //  return $this->_helper->redirector('index');
                return $this->_redirect("thread/thread/id/".$data['thread_id']);

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

         $data=$mapper->find($id);
         $reply=$mapper->remove($id);


      return $this->_redirect("thread/thread/id/".$data->getThread_id());
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
                //var_dump("aaaaaa"); die();
                $data = $this->getRequest()->getParams();
                $data['reply_id']=$reply['reply_id'];
                $data['thread_id']=$reply['thread_id'];
                $data['reply_id']=$reply['reply_id'];
                $reply = new Application_Model_ThreadReply($data);
                $mapper = new Application_Model_ThreadReplyMapper();
                $reply->setReply_id($id);
                $mapper->save($reply);
                 return $this->_redirect("thread/thread/id/".$data['thread_id']);
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
