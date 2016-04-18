<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_CategoryMapper();
        $this->view->categorys = $mapper->fetchAll();
    }

    public function createAction()
    {
        // action body
    }


}


