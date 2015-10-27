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


class Form_Recherche extends Zend_Form {
	
	
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
		                    array('HtmlTag', array('tag' => 'p', 'id'=>'element_text')),);
                     

		$search = new Zend_Form_Element_Text('search');
		$search->setLabel('Rechercher');
		$search-> setAttrib('class', 'text');
		$search->setDecorators($decorator);
		$search->setAttrib('onkeyup', "if(event.keyCode!=13){chercher(0)}");
		$search->setAttrib('onFocus', "chercher(0)");
		$search->setAttrib('onblur', 'if(closeListe == true){$("#resultatRecherche").css("display", "none");}');
		
		
		$decorator = array( array('ViewHelper'),
		                 array('Label'), 
		                 array('HtmlTag', array('tag' => 'p', 'id'=>'element_select')),);
		
		
		$category = new Category();
		$listCateg = $category->getOnlineCategory();
		
		$choix = new Zend_Form_Element_Select('choix');
		$choix-> setAttrib('class', 'select');
		$choix->setLabel('dans');
		$choix->addMultiOption(0, 'Toutes catégories');
		
		foreach($listCateg as $c){
			$choix->addMultiOption($c->idCategory, html_entity_decode($c->name, ENT_QUOTES, 'UTF-8'));
		}
		$choix->setDecorators($decorator);
		$choix->setAttrib('onChange', "chercher(0);setChoice()");
		$choix->setAttrib('onblur', 'if(closeListe == true){$("#resultatRecherche").css("display", "none");}');
		
		/* Pas de catégories
		$choix = new Zend_Form_Element_Select('choix');
		$choix-> setAttrib('class', 'select');
		$choix->setLabel('in');
		$choix->addMultiOptions(array('0'=>'All', '1'=>'Clinical tips & tricks', '2'=>'Complications', '3'=>'Open discussion', '4'=>'More viewed', '5'=>'Best rated'));
		$choix->setValue(0);
		$choix->setDecorators($decorator);
		$choix->setAttrib('onchange', "showView('listeAbstract', '/ePoster/index/listecomplete', {'choix':$('#choix').val(), 'search':$('#search').val()}); return false;");
		*/
			
		$this->addElements ( array($search, $choix) );
	
	
	}
	
	
}
