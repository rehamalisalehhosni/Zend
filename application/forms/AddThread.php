<?php

class Application_Form_AddThread extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
         $this->setMethod('post');

        $thread_title = new Zend_Form_Element_Text("thread_title");
        $thread_title->setRequired();
        $thread_title->setlabel("Thread Title:");
        $thread_title->setAttrib("class","form-control");
        $thread_title->setAttrib("placeholder","Enter Thread Title");
        $thread_title->addValidator(new Zend_Validate_Alpha());

		$thread_body =  new Zend_Form_Element_Textarea('thread_body');
		$thread_body ->setRequired();
		$thread_body->setLabel('Enter the post');
		$thread_body->setAttrib("class","form-control");
		$thread_body->setAttrib("placeholder","Enter ur Thread Body");


        /*$element = new Zend_Form_Element_File('image');
        $destination = APPLICATION_PATH.'/../public/upload/user_image';
        #var_dump($destination); exit();
        $element->setLabel('Upload an image:')
                ->setDestination($destination);
        // ensure only 1 file
        $element->addValidator('Count', false, 1);
        // limit to 100K
        $element->addValidator('Size', false, 10240000);
        // only JPEG, PNG, and GIFs
        $element->addValidator('Extension', false, 'jpg,png,gif');
        $this->addElement($element, 'image');
        $this->setAttrib('enctype', 'multipart/form-data');
		*/

		$submit=new Zend_Form_Element_Submit("submit");
		$submit->setValue("Add Thread");

		$this->addElements(array($thread_title,$thread_body,$submit ));
    }


}
?>
