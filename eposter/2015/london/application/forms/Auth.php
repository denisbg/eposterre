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



class Form_Auth extends Zend_Form {
	
	
	public function init() {
	
		$this->setName('formulaire'); //nom du formulaire
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');


		$decorator = array( array('ViewHelper'),
		                    array('Label'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'element_form')),);

		/* login de l'utilisateur */
		$login = new Zend_Form_Element_Text('username');
		$login->setLabel('Nom d\'utilisateur')
				-> setAttrib('class', array('medium', 'text'));
		$login->setDecorators($decorator);
		
		/*mot de passe*/
		$mdp = new Zend_Form_Element_Password('password');
		$mdp->setLabel('Mot de passe')
				-> setAttrib('class', array('medium', 'text'));
		$mdp->setDecorators($decorator);
		
		/*Bouton de validation*/
		$submit = new Zend_Form_Element_Submit('ValiderLoginHome');
		$submit->setLabel('Se connecter')
				-> setAttrib('class', 'button');
		$submit->setDecorators(array( array('ViewHelper'),
		                    array('HtmlTag', array('tag' => 'p', 'id'=>'button_form')),));
	
		$this->addElements ( array($login, $mdp, $submit) );
	
	
	}
	
	
}
