<?php

class ThreadController extends Zend_Controller_Action
{

    protected $auth ;

    public function init()
    {
        /* Initialize action controller here */
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
                $identity = $this->auth->getIdentity();
                $this->view->user_name = $this->auth->getIdentity()->user_name;
                $this->view->user_email= $this->auth->getIdentity()->user_email;
                $this->view->user_type = $this->auth->getIdentity()->user_type;
                $this->view->image =  $this->auth->getIdentity()->image;
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
       if($this->auth->getIdentity()->user_type=="admin" ){
            $mapper = new Application_Model_ThreadMapper();
            $this->view->threads = $mapper->fetchAll();
        // action body
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        }
    }

    public function addAction()
    {
        // action body
      $id = $this->getRequest()->getParam('id'); 
      $cat_mapper = new Application_Model_CategoryMapper();
      //problem in other users
     if ($this->auth->hasIdentity()&&$cat_mapper->categoryExistsId($id)!=0&&$cat_mapper->categoryState($id)!=0) {
            $form = new Application_Form_AddThread();
            $request = $this->getRequest();
            if($this->auth->getIdentity()->user_type!="admin"){
                $form->removeElement('thread_state_id');
                $form->removeElement('thread_sticky');
            }
            if ($request->isPost()) {
                if ($form->isValid($request->getPost())) {     
                    $data = $this->getRequest()->getParams();
                    $data['date']=date('Y-m-d');
                if($this->auth->getIdentity()->user_type!="admin"){
                    $data['thread_state_id']=1; //active thread non-blocked
                    $data['thread_sticky']=0; //active thread non-blocked
                }
                    $data['category_id']= $id; //from category session
                    $data['owner_id']=$this->auth ->getIdentity()->user_id;//from user session
    /*                $form->getValues()['registration_date']=date('Y-m-d');
    */              $thread = new Application_Model_Thread($data);
                    $mapper = new Application_Model_ThreadMapper();
                    $mapper->save($thread);
                    return $this->_redirect('/index/index');    
                }
            } 
            $this->view->form = $form;
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        }
    }

    public function deleteAction()
    {
        // action body
        $mapper = new Application_Model_ThreadMapper();
        $thread=$mapper->find_array($id)[0];
       $id = $this->getRequest()->getParam('id'); 
      if ($this->auth->hasIdentity()->user_id==$thread['user_id']||$this->auth->getIdentity()->user_type=="admin") {
            $thread=$mapper->remove($id);
            return $this->_helper->redirector('delete');
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        } 
    }
    public function editAction()
    {
        // action body
        $request = $this->getRequest();
        $form = new Application_Form_AddThread();
        $mapper = new Application_Model_ThreadMapper();
        $id = $this->getRequest()->getParam('id');      
         $threads=$mapper->find($id);
      if ($this->auth->getIdentity()->user_id==$threads->getOwner_id()||$this->auth->getIdentity()->user_type=="admin") {
          $thread=$mapper->find_array($id)[0];
    /*        $this->view->image=$data['image'];
    */      $form->populate($thread);
            #$form->getElement('user_password')->setRequired(false);
            if($this->auth->getIdentity()->user_type!="admin"){
                $form->removeElement('thread_state_id');
                $form->removeElement('thread_sticky');
            }

            if ($request->isPost()) {
                if ($form->isValid($request->getPost())) {    
                    $data = $this->getRequest()->getParams();
                    if($this->auth->getIdentity()->user_type!="admin"){
                        $data['thread_state_id']=1; //active thread non-blocked
                        $data['thread_sticky']=0; //active thread non-blocked
                     }
                    $data['category_id']=  $threads->getCategory_id(); //from category session
                    $data['owner_id']=$this->auth ->getIdentity()->user_id;//from user session

                    $thread = new Application_Model_Thread($data);
                    $mapper = new Application_Model_ThreadMapper();
                    $thread->setThread_id($id);
                    $mapper->save($thread);
                    return $this->_redirect("/index/index"); //idont know helper
                   // return $this->_helper->redirector('index'); //idont know helper
                }
            }         
            $this->view->form = $form;   
        }else{
            return $this->_redirect("/Error-Page/"); //idont know helper
        } 
    }

    public function listAction()
    {
        // action body
        $mapper = new Application_Model_ThreadMapper();
        $this->view->threads = $mapper->fetchAll();
    }

    public function threadAction()
    {
        // action body
        //single page thread
        $id = $this->getRequest()->getParam('id'); 
        $mapper = new Application_Model_ThreadMapper();
        $this->view->thread = $mapper->getThread($id);
        //$this->view->replay = $mapper->getReply($id);

    }

    public function threadCategoryAction()
    {
      $id = $this->getRequest()->getParam('id'); 
      $mapper = new Application_Model_ThreadMapper();
      $this->view->threads = $mapper->getThread_category($id);   
      $cat = new Application_Model_CategoryMapper();
      $this->view->cat = $cat->find($id);
      $this->view->Parcat = $cat->find($this->view->cat->getCategory_parent());
        // action body
      $mapperReplay= new Application_Model_ThreadReplyMapper();
      $this->view->threadreplay = $mapperReplay;


    }


}













