<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2010
 * @version 1.0
 */

/**
 * Form_Recherche
 * @package Forms
 */


class Form_Recherche_Rapide extends Zend_Form {
	
	
	public function init() 
	{
	
		$this->setName ('recherche'); //nom du formulaire
		$this->setAttrib('class', 'formulaire');
		$this->setAttrib('onsubmit', "return false;");
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');


		$decorator = array( array('ViewHelper'),
		                    array('Label'), 
		                    array('HtmlTag', array('tag' => 'p', 'class'=>'element_text')),);
                     

		$search = new Zend_Form_Element_Text('search');
		$search->setLabel('Rechercher');
		$search->setAttrib('class', 'text');
		$search->setDecorators($decorator);
		$search->setAttrib('onkeyup', "if(event.keyCode!=13){chercher()}else{return false;}");
		$search->setAttrib('onblur', "if(closeListe == true){document.getElementById('resultatRecherche').style.display = 'none'}");

	
		$this->addElements ( array($search) );
	
	
	}
	
	
}
