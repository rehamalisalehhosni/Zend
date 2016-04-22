<?php

class CategoryController extends Zend_Controller_Action
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
        $mapper = new Application_Model_CategoryMapper();
        $this->view->cats = $mapper->fetchAll();
    }

    public function createAction()
    {
        $form = new Application_Form_CreateCategory();
        $mapper = new Application_Model_CategoryMapper();
        $mainCats = $mapper->findMainCats();
        $parents = array();
        foreach ($mainCats as $cat) {
            $parents[$cat->getCategory_id()] = $cat->getCategory_name();
        }
    #    var_dump($mainCats); exit();
        $form->setParents($parents);
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $data = $this->getRequest()->getParams();
                $category = new Application_Model_Category($data);
                if ($mapper->categoryExists($data['category_name'])) {
                    return $this->view->error = 'category already exists';
                } else {
                    #var_dump($category); exit();
                    $mapper->save($category);

                    return $this->_helper->redirector('index');
                }
            }
        }
        $this->view->form = $form;

    }

    public function deleteAction()
    {
        $users = new Application_Model_Category();
        $mapper = new Application_Model_CategoryMapper();
        $id = $this->getRequest()->getParam('id');
        $mapper->remove($id);
        return $this->_helper->redirector('index');
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_CreateCategory();
        $mapper = new Application_Model_CategoryMapper();
        $cat = $mapper->find_array($id);
        $mainCats = $mapper->findMainCats();
        $parents = array();
        $form->populate($cat);

        foreach ($mainCats as $cat) {
            $parents[$cat->getCategory_id()] = $cat->getCategory_name();
        }
    //    var_dump($mainCats); exit();
        $form->setParents($parents);
        #var_dump($cat); exit();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $data = $this->getRequest()->getParams();
                $category = new Application_Model_Category($data);
                $category->setCategory_id($id);
                #var_dump($category); exit();
                $mapper->save($category);
                return $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }


}
