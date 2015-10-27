<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * Form_ValiderMail
 * @package Form
 */



class Form_ValiderMail extends Zend_Form {
	
	
	public function init(){
	
		$this->setName('validerMail'); //nom du formulaire
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');


		$decorator = array( array('ViewHelper'),
		                    array('Label'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'element_form')),);


		
		/*Bouton de validation*/
		$submit = new Zend_Form_Element_Submit('ValiderMail');
		$submit->setLabel('Envoyer les emails')
				-> setAttrib('class', 'button');
		$submit->setDecorators(array( array('ViewHelper'), array('HtmlTag', array('tag' => 'p', 'id'=>'button_form')),));
	
	
		$this->addElements ( array($submit) );
	
	
	}
	
	
}
