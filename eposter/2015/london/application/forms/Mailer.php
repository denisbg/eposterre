<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * Form_Mailer
 * @package Form
 */



class Form_Mailer extends Zend_Form {
	
	
	public function __construct($options = null, $abstract, $baseUrl){
	
		$this->setName('mailer'); //nom du formulaire
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');


		$decorator = array( array('ViewHelper'),
		                    array('Label'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'element_form')),);

		/* nom de l'utilisateur */
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel($this->getView()->translate('Nom'))
				-> setAttrib('class', array('medium', 'text'))
				->setRequired(true);
		$name->setDecorators($decorator);
		
		/* nom de l'utilisateur */
		$mail = new Zend_Form_Element_Text('mail');
		$mail->setLabel($this->getView()->translate('Email'))
				-> setAttrib('class', array('medium', 'text'));
		$mail->setDecorators($decorator);
		
		/* nom de l'utilisateur */
		$objet = new Zend_Form_Element_Text('subject');
		$objet->setLabel($this->getView()->translate('Sujet'))
				-> setAttrib('class', array('medium', 'text'))
				->setRequired(true);
		$objet->setDecorators($decorator);
		
		/*Commentaire*/
		$message = new Zend_Form_Element_Textarea('message');
		$message->setLabel($this->getView()->translate('Message'))
				->setRequired(true)
				-> setAttrib('class', 'textarea');
		$message->setDecorators($decorator);
		
		/*Bouton de validation*/
		$submit = new Zend_Form_Element_Button('ValiderMail');
		$submit->setLabel($this->getView()->translate('Valider'))
				-> setAttrib('class', 'button')
				-> setAttrib('onclick', "checkFormMail('".$baseUrl."', '".$abstract."'); return false;");
		$submit->setDecorators(array( array('ViewHelper'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'button_form')),));
	
		$cancel = new Zend_Form_Element_Button('CancelMail');
		$cancel->setLabel($this->getView()->translate('Annuler'))
				-> setAttrib('class', 'button')
				-> setAttrib('onclick', "deleteOverlay(); return false;");
		$cancel->setDecorators(array( array('ViewHelper'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'button_form')),));
	
		$this->addElements ( array($name, $mail, $objet, $message, $cancel, $submit) );
	
	
	}
	
	
}
