<?php

class Application_Form_CreateCategory extends Zend_Form
{
        $categoryName = new Zend_Form_Element_Text('category_name');
        $categoryName->class = 'formtext';
        $categoryName->setLabel('Category Name:')
                 ->setDecorators(array(
                     array('ViewHelper',
                           array('helper' => 'formText')),
                     array('Label',
                           array('class' => 'label'))
                 ));


        $submit = new Zend_Form_Element_Submit('Create');
        $submit->class = 'formsubmit';
        $submit->setValue('Login')
               ->setDecorators(array(
                   array('ViewHelper',
                   array('helper' => 'formSubmit'))
               ));

        $this->addElements(array(
            $categoryName,
            $submit
        ));

        $this->setDecorators(array(
            'FormElements',
            'Fieldset',
            'Form'
        ));
    }


}
