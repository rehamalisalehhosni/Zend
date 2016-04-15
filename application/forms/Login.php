<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');
                // Add an email element
        $this->addElement('text', 'user_email', array(
           'label'      => 'Email:',
           'required'   => true,
           'class'      => 'form-control',
           'filters'    => array('StringTrim'),
           'validators' => array(
            'EmailAddress',
               )
        ));
        $this->addElement('password', 'user_password', array(
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

