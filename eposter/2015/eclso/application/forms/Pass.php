<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * Form_LoginAuth
 * @package Form
 */



class Form_Pass extends Zend_Form {
	
	
	public function init() {
	
		$this->setName('formulaire'); //nom du formulaire
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');


		$decorator = array( array('ViewHelper'),
		                    array('Label'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'element_form')),);
		
		/*mot de passe*/
		$mdp = new Zend_Form_Element_Password('code');
		$mdp->setLabel('Mot de passe')
				-> setAttrib('class', array('tiny', 'text'));
		$mdp->setDecorators($decorator);
		
		/*Bouton de validation*/
		$submit = new Zend_Form_Element_Submit('ValiderPass');
		$submit->setLabel('Se connecter')
				-> setAttrib('class', 'button');
		$submit->setDecorators(array( array('ViewHelper'),
		                    array('HtmlTag', array('tag' => 'p', 'id'=>'button_form')),));
	
		$this->addElements ( array($mdp, $submit) );
	
	
	}
	
	
}
