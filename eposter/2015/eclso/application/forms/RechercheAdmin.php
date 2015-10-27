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


class Form_RechercheAdmin extends Zend_Form {
	
	
	public function init() 
	{
	
		$this->setName ('recherche'); //nom du formulaire
		$this->setAttrib('class', 'formulaire');
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');


		$decoratorT = array( array('ViewHelper'),
		                    array('Label'), 
		                    array('HtmlTag', array('tag' => 'p', 'id'=>'element_text')),);
                     

		$search = new Zend_Form_Element_Text('search');
		$search->setLabel('Rechercher :');
		$search->setDecorators($decoratorT);
		$search-> setAttrib('class', 'text');
		$search->setAttrib('onkeyup', "if(event.keyCode!=13){chercher(1)}");
		$search->setAttrib('onblur', 'if(closeListe == true){$("#resultatRecherche").css("display", "none");}');
		
		$decoratorS = array( array('ViewHelper'),
		                 array('Label'), 
		                 array('HtmlTag', array('tag' => 'p', 'id'=>'element_select')),);
		
		
		/*
		Pas de catégories
		$choix = new Zend_Form_Element_Select('choix');
		$choix-> setAttrib('class', 'select');
		$choix->setLabel('dans');
		$choix->addMultiOptions(array('0'=>'All', '1'=>'Clinical tips & tricks', '2'=>'Complications', '3'=>'Open discussion', '4'=>'More viewed', '5'=>'Best rated'));
		$choix->setValue(0);
		$choix->setDecorators($decoratorS);
		$choix->setAttrib('onchange', "showView('listeAbstract', '/ePoster/admin/index', {'choix':$('#choix').val(), 'search':$('#search').val()}); return false;");
		*/
	
		$this->addElements ( array( $search) );
	
	
	}
	
	
}
