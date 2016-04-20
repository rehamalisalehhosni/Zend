<?php

class Application_Form_Message extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
         $this->setMethod('post');
         $to_user = new Zend_Form_Element_Hidden("to_user");
         $from_user = new Zend_Form_Element_Hidden("from_user");
         $auth = Zend_Auth::getInstance();
         $from_user->setValue($auth->getIdentity()->user_id);
         $message = new Zend_Form_Element_Textarea("message");
         $message->setLabel('Message:')
			    ->setRequired(true)
			    ->setAttrib('COLS', '40')
			    ->setAttrib('ROWS', '4');
         $id = new Zend_Form_Element_Hidden("id");
         $this->addElement($from_user);
         $this->addElement($to_user);
         $this->addElement($message);
        // Add an email element
         $this->addElement('text', 'subject', array(
            'label' => 'subject :',
            'class' => 'form-control',
            'required' => true,
            'filters' => array('StringTrim'),
        ));
         
          $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Save',
        ));
    }


}

