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


class Form_Search extends Zend_Form {
	
	 public function __construct($options = null, $type, $baseUrl){

        parent::__construct($options);
        
		$this->setName ('search'); //nom du formulaire
		$this->setAttrib('class', 'formulaire');
		$this->setAttrib('id', 'rechercheBox');
		
		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');

		$decorator = array( array('ViewHelper'),
		                    array('Label'), 
		                    array('HtmlTag', array('tag' => 'p', 'id'=>'element_text')),);
                     
		$search = new Zend_Form_Element_Text('search');
		$search->setLabel('Rechercher');
		$search->setAttrib('class', 'text');
		$search->setDecorators($decorator);
		$search->setAttrib("onkeyup", "showView('results', '".$baseUrl."/index/search/type/".$type."/layout/1', {data:$(this).attr('value')});");
		
		$this->addElement($search);
	}
}
