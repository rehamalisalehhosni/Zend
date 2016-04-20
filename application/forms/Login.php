<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
       /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');
        $baseUrlHelper= new Zend_View_Helper_BaseUrl();
        $this->setAction($baseUrlHelper->baseUrl('auth/login'));
                // Add an email element
        $this->addElement('text', 'email', array(
           'label'      => 'Email:',
           'required'   => true,
           'class'      => 'form-control',
           'filters'    => array('StringTrim'),
           'validators' => array(
            'EmailAddress',
               )
        ));
        $this->addElement('password', 'password', array(
           'label'      => 'password :',
           'required'   => true,
           'class'      => 'form-control',
           'validators' => array(
           'StringLength',
           )
        ));
        // Add the submit button
        $this->addElement('submit', 'submit', array(
           'ignore'   => true,
           'label'    => 'Save',
        ));
    }


}

