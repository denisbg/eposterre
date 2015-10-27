<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2010
 * @version 1.0
 */

/**
 * Form_ModifierAbstract
 * @package Forms
 */


class Form_ModifierAbstract extends Zend_Form {
	
	
	public function init() 
	{
	
		$this->setName ('modifierAbstract'); //nom du formulaire
		$this->setAttrib('class', 'formulaire');
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');


		$decorator = array( array('ViewHelper'),
		                    array('Label'), 
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'element_check')),);
                     

$elementDecorator = array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'th')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        );

		$file = new Zend_Form_Element_File('movie');
		$file->setLabel('Déposer une vidéo :');
		$file-> setAttrib('class', 'file');
		$file->addValidator('size', false, 2048000);
		$file->setDecorators(array( 'Label','File', array('HtmlTag', array('tag' => 'p', 'class'=>'element_file'))));
		
		$moderate = new Zend_Form_Element_Checkbox('moderate');
		$moderate->setLabel('Open discussion :');
		$moderate-> setAttrib('class', 'checkbox');
		$moderate->setDecorators($decorator);
		
		$submit = new Zend_Form_Element_Submit('ValiderModifierAbstract');
		$submit->setLabel('Valider')
				-> setAttrib('class', 'button');
		$submit->setDecorators(array( array('ViewHelper'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'button_form')),));
	
		$this->addElements ( array($file, $moderate, $submit) );
	
	
	}
	
	
}
