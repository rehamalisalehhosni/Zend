<?php

class Application_Form_CreateCategory extends Zend_Form
{
    private $parent;

    public function init()
    {
        $this->parent = new Zend_Form_Element_Select('category_parent');
        $categoryName = new Zend_Form_Element_Text('category_name');
        $categoryName->class = 'formtext form-control';

        $categoryName->setLabel('Category Name:')
                     ->setDecorators(array(
                     array('ViewHelper',array('helper' => 'formText'), ),
                     array('Label'),
                 ));
        $description = new Zend_Form_Element_Textarea('category_description');
        $description->setLabel('Description :')
            ->setRequired(true)
            ->setAttrib('cols', '40')
            ->setAttrib('class', 'form-control')
            ->setAttrib('rows', '4');
        $this->parent->setLabel("Parent Category");
        $this->parent->setAttrib('class', 'form-control');
        $state = new Zend_Form_Element_Radio('category_state');
        $state->addMultiOptions(array('1'=>'on', '0'=>'off'))
                ->setRequired(true)
                ->setLabel("State");
         $this->setDefault("category_state",'on'); // Set default value for element


                

        $submit = new Zend_Form_Element_Submit('Create');
        $submit->class = 'formsubmit';
        $submit->setValue('Login')
               ->setDecorators(array(
                   array('ViewHelper',
                   array('helper' => 'formSubmit'), ),
               ));
        $this->addElements(array(
            $categoryName,
            $this->parent,
            $description,
            $state,
            $submit,
        ));

        $this->setDecorators(array(
            'FormElements',
            'Fieldset',
            'Form',
        ));
    }
    function setParents(array $parents) {
        //var_dump($parents); exit();
       
        $this->parent->addMultiOptions($parents);
        #$this->populate(array("General" => "1"));
    }
}
