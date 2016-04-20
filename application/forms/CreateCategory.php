<?php

class Application_Form_CreateCategory extends Zend_Form
{
    private $parent;

    public function init()
    {
        $this->parent = new Zend_Form_Element_Select('category_parent');
        $categoryName = new Zend_Form_Element_Text('category_name');
        $categoryName->class = 'formtext';
        $categoryName->setLabel('Category Name:')
                 ->setDecorators(array(
                     array('ViewHelper',
                           array('helper' => 'formText'), ),
                     array('Label',
                           array('class' => 'label'), ),
                 ));
        $description = new Zend_Form_Element_Textarea('category_description');
        $description->setLabel('Description :')
            ->setRequired(true)
            ->setAttrib('cols', '40')
            ->setAttrib('rows', '4');

        $this->parent->setLabel("Parent");
        $state = new Zend_Form_Element_Radio('category_state');
        $state->addMultiOptions(array('1'=>'on', '0'=>'off'))
                ->setRequired(true)
                ->setLabel("State");
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
