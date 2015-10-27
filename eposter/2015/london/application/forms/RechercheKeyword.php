<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2010
 * @version 1.0
 */

/**
 * Form_Search_Keyword
 * @package Forms
 */


class Form_Search_Keyword extends Zend_Form {
	
	
	 public function __construct($options = null, $keywords){

        parent::__construct($options);
	
		$this->setName ('searchKeyword'); //nom du formulaire
		$this->setAttrib('class', 'formulaire');

		$this->clearDecorators()
   			 ->addDecorator('FormElements')
   			 ->addDecorator('Form');

                     
		$temp = array();
		foreach($keywords as $key=>$data){
			$search = new Zend_Form_Element_Checkbox("'".$key."'");
			$search->setLabel($data["data"])
				->setAttrib('onclick', 'var tab = [];$("input[type=checkbox]:checked").each(function(){tab.push($(this).attr("id"));});;showView("content", "/temp/london/index/keywords/layout/1", {data:JSON.stringify(tab)});');
			if($data["hidden"] == 1){
				$search->setAttrib("disable", "disabled");
			}
			$search->setDecorators(array( array('ViewHelper'),
                    array('Label'), 
                    array('HtmlTag', array('tag' => 'p', 'class'=>'element_check')),));
			array_push($temp, $search);				
		}
			
		

	
		$this->addElements($temp);
	
	
	}
	
	
}
