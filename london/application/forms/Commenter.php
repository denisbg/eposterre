<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * Form_Commenter
 * @package Form
 */



class Form_Commenter extends Zend_Form {
	
	
	public function __construct($options = null, $abstract, $baseUrl){
	
		$this->setName('commenter'); //nom du formulaire
		
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
		
		/*Commentaire*/
		$comment = new Zend_Form_Element_Textarea('comment');
		$comment->setLabel($this->getView()->translate('Commentaire'))
				->setRequired(true)
				-> setAttrib('class', 'textarea');
		$comment->setDecorators($decorator);
		
		/*Bouton de validation*/
		$submit = new Zend_Form_Element_Button('ValiderCommentaire');
		$submit->setLabel($this->getView()->translate('Valider'))
				-> setAttrib('class', 'button')
				-> setAttrib('onclick', "checkFormComment('".$baseUrl."', '".$abstract."'); return false;");
		$submit->setDecorators(array( array('ViewHelper'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'button_form')),));
	
		$cancel = new Zend_Form_Element_Button('CancelCommentaire');
		$cancel->setLabel($this->getView()->translate('Annuler'))
				-> setAttrib('class', 'button')
				-> setAttrib('onclick', "deleteOverlay(); return false;");
		$cancel->setDecorators(array( array('ViewHelper'),
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'button_form')),));
		                    
		$this->addElements ( array($name, $comment, $cancel, $submit) );
	
	
	}
	
	
}
