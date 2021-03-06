<?php

class Application_Form_Signup extends Zend_Form
{
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
            /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'user_name', array(
            'label' => ' user name :',
            'class' => 'form-control',
            'required' => true,
            'filters' => array('StringTrim'),

        ));
 // Add an email element
        $this->addElement('text', 'user_email', array(
            'label' => ' email address:',
            'required' => true,
            'class' => 'form-control',
            'filters' => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            ),
        ));


        $this->addElement('password', 'user_password', array(
            'label' => ' user_password:',
            'class' => 'form-control',
            'required' => true,
            'filters' => array('StringTrim'),

        ));

        $this->addElement('text', 'country', array(
                    'label'      => ' country :',
                    'class'      => 'form-control',
                    'required'   => true,
                    'filters'    => array('StringTrim'),
                ));

        $element = new Zend_Form_Element_File('image');
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
        $gender = new Zend_Form_Element_Radio('gender');
        $gender->setLabel('Gender:')->addMultiOptions(array(
            'male' => 'Male',
            'female' => 'Female',
          ))->setSeparator('');
        $gender->setAttrib('class', 'radio-inline');
        $this->addElement($gender, 'gender');
           // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label' => 'Please enter the 5 letters displayed below:',
            'required' => true,
            'captcha' => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300,
            ),
        ));
        $ban = new Zend_Form_Element_Radio('ban');
        $ban->addMultiOptions(array('1'=>'yes', '0'=>'no'))
                ->setRequired(true)
                ->setLabel("ban");
         $this->setDefault("ban",'no'); // Set default value for element
         $this->addElement($ban);
        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Save',
        ));
    }
}
