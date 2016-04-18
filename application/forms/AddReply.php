<?php

class Application_Form_AddReply extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $reply_body =  new Zend_Form_Element_Textarea('reply_body');
		$reply_body ->setRequired();
		$reply_body->setLabel('Enter the reply');
		$reply_body->setAttrib("class","form-control");
		$reply_body->setAttrib("placeholder","Enter ur Reply");
		

		$submit=new Zend_Form_Element_Submit("submit");
		$submit->setValue("Add Thread");

		$this->addElements(array($reply_body,$submit ));

    }


}

?>