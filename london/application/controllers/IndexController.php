<?php
/**
 * ePoster v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2010
 * @version 1.0
 */

/**
 * IndexController
 * @package Controllers
 */
 

/*---Formulaire----*/ 
require_once APPLICATION_PATH.'/application/forms/Recherche.php'; 
require_once APPLICATION_PATH.'/application/forms/RechercheKeyword.php'; 
require_once APPLICATION_PATH.'/application/forms/Commenter.php';  
require_once APPLICATION_PATH.'/application/forms/Mailer.php'; 


class IndexController extends Zend_Controller_Action {


    public function init(){
		 $this->view->baseUrl = $this->_request->getBaseUrl();
		 $this->view->user = Zend_Auth::getInstance()->getIdentity(); //recupere l'identite de l'utilisateur
		 $this->view->controller =  $this->_request->controller; 
		 $this->view->action =  $this->_request->action; 
    }

 	public function preDispatch(){}
   
    function indexAction(){}
    
    //research by author and title
    function searchAction(){
    	
  		if($this->_hasParam("type")){
  			$type = $this->getRequest()->getParam("type");
  		
	    	$form = new Form_Search(array('action' => $this->view->url(array('action' => 'listecomplete')),'method' => 'POST'), $type, $this->_request->getBaseUrl());
			$this->view->form = $form;
	    		    	
	  		if($this->_hasParam('data')){
	        	$search = $this->_request->getParam('data');
	    
	        	if($this->_hasParam('layout')){
	        		$this->_helper->layout->disableLayout();
	        		$this->view->search = true;
	        	}else{
		        	$form->populate(array("search"=>$search));
	        	}	        	
	        }else{
		        $search = null;
	        }
			$resume = new Resume();
	   		$this->view->resume = $resume->getAllAbstract(addslashes($search), $type);
	   		
	   		$history = new Zend_Session_Namespace('ariane');
	   		//Fil d'ariane
	   		if($type == "author"){
		   		$this->view->ariane = "&nbsp;&raquo;&nbsp;".$this->view->translate('Recherche par auteur');
		   		$history->searchType = "<a href='".$this->_request->getBaseUrl()."/index/search/type/author/data/".$search."'>".$this->view->translate('Recherche par auteur')."</a>";
	   		}elseif($type == "title"){
		   		$this->view->ariane = "&nbsp;&raquo;&nbsp;".$this->view->translate('Recherche par titre');
		   		$history->searchType = "<a href='".$this->_request->getBaseUrl()."/index/search/type/title/data/".$search."'>".$this->view->translate('Recherche par titre')."</a>";
	   		}
	   		$note = new Note();
			$this->view->note = $note->getNote();
			
			$this->render();
		}
    }
    
    //research by keywords
    function keywordsAction(){
		
		
		if($this->_hasParam("data")){
			$keywords = $this->_request->getParam('data');
		}else{
			$keywords = null;
		}
		
		$keyword = new Keyword();
    	$listKeywords= $keyword->getKeywords();
    	
    	$tabKeyword =array();
    	foreach($listKeywords as $key){ 
	 		if(!array_key_exists($key->idKeyword, $tabKeyword)){
		 		$tabKeyword[$key->idKeyword] = array();
		 	}
		 	$tabKeyword[$key->idKeyword] = array("data"=>$key->keywordData, "family"=>$key->familyData);
    	}

    	if(count(Zend_Json::decode($keywords))>0){
    		$listKeywordsUsed= $keyword->getKeywordsUsed(Zend_Json::decode($keywords));
    		$tabAssociateKeyword = array();
			foreach($listKeywordsUsed as $key){ 
		 		if(!in_array($key->keyword_idKeyword, $tabAssociateKeyword)){
			 		array_push($tabAssociateKeyword, $key->keyword_idKeyword);
			 	}
	    	}
	    	$this->view->associateKeyword = $tabAssociateKeyword;
	    }
	    
	    
	    
		$this->view->keywords = $tabKeyword;
	    
	    $note = new Note();
		$this->view->note = $note->getNote();
	    
    	/*$form = new Form_Search_keyword(array('action' => $this->view->url(array('action' => 'keywords')),'method' => 'POST'), $tabKeyword);
		$this->view->form = $form;*/
		
		$resume = new Resume();
		if($this->_hasParam("data")){
		

	   		if(count(Zend_Json::decode($keywords))>0){
	   			$this->view->resume = $resume->getAllAbstractKeywords(Zend_Json::decode($keywords));
	   		}else{
		   		$this->view->resume = $resume->getAllAbstract(null, "title");  	
	   		}
	   		
	   		$history = new Zend_Session_Namespace('ariane');
	   		//Fil d'ariane
	   		$this->view->ariane = "&nbsp;&raquo;&nbsp;".$this->view->translate('Liste');
	   		$history->searchType = "<a href='".$this->_request->getBaseUrl()."/index/keywords/data/".$keywords."'>".$this->view->translate('Liste')."</a>";
	   		
	  
	   		if($this->_hasParam('layout')){
	        	$this->_helper->layout->disableLayout();
	        }
	        if(count(Zend_Json::decode($keywords))>0){
	        	$tabPopulate = array();
	        	foreach(Zend_Json::decode($keywords) as $key){
		        	$tabPopulate[$key] = 1;
	        	}
		        $this->view->populate = $tabPopulate;
		    }
		}else{	  
			$this->view->resume = $resume->getAllAbstract(null, "title");  	
			$history = new Zend_Session_Namespace('ariane');
	   		//Fil d'ariane
			$this->view->ariane = "&nbsp;&raquo;&nbsp;".$this->view->translate('Liste');
			$history->searchType = "<a href='".$this->_request->getBaseUrl()."/index/keywords'>".$this->view->translate('Liste')."</a>";
		}
	   		
		$this->render();
	
    }
    
    
    
    //affichge du texte
    function abstractAction(){
    	
  		if($this->_hasParam("id")){
  			$abstract = $this->getRequest()->getParam("id");
  			
  			if(Zend_Registry::get('config')->option->view == true){
	   			$view = new View();
	   			$view->updateViewAbstract($abstract);
	   		}
	   		
			$resume = new Resume();
	   		$this->view->resume = $resume->getAbstractById($abstract);
	   		
	   		$congres = new Congres();
	   		$this->view->congres = $congres->getInfoCongres();
	   		
	   		//Fil d'ariane
	   		$history = new Zend_Session_Namespace('ariane');
	   		
	   		$this->view->ariane = "&nbsp;&raquo;&nbsp;".$history->searchType.'&nbsp;&raquo;&nbsp;'.$this->view->translate('ePoster');
	   		
	   		if(Zend_Registry::get('config')->option->notation == true){
				$this->view->headScript()->prependScript('$(document).ready(function(){addNote("'.$this->_request->getBaseUrl().'", '.$abstract.'); return false;})');
			}
	   		
	   		
			$this->render();

		}
    } 
    
    
    public function commenterAction(){
  
  		if($this->_hasParam('abstract')){
        	$id = $this->_request->getParam('abstract');

			$comment = new Comment();

  			if($this->_request->isPost()){
  			
  				$commentaire = $this->_request->getPost('comment');
  				$nom = $this->_request->getPost('name');
  				
  				
  				$comment->insertComment($id, $nom, $commentaire);
  			
  				$this->view->form = $this->view->translate('Commentaire ajouté');
  				
  			}else{
  				$form = new Form_Commenter(array('action' => $this->view->url(array('action' => 'commenter')),'method' => 'POST'), $id, $this->_request->getBaseUrl());
				$this->view->form = $form;
  			}
  			
  			$this->view->comment = $comment->getCommentsByIdPoster($id);
  			
  			$this->view->abstract = $id;
  			
  			$this->render();
    		$this->_helper->layout->disableLayout();
  		}
  	}	
    
    
    public function mailerAction(){
  
  		if($this->_hasParam('abstract'))
        {
        	$id = $this->_request->getParam('abstract');

  			if($this->_request->isPost()){
  			
  				$message = $this->_request->getPost('message');
  				$nom = $this->_request->getPost('name');
  				$mail = $this->_request->getPost('mail');
  				$objet = $this->_request->getPost('subject');
  				
  				$comment = new Mail();
  				$comment->insertMail($id, $nom, $mail, $objet, $message);
  				
  				$this->view->form = $this->view->translate('Email envoyé');
  				
  				
  			}else{
  				$form = new Form_Mailer(array('action' => $this->view->url(array('action' => 'mailer')),'method' => 'POST'), $id, $this->_request->getBaseUrl());
				$this->view->form = $form;
  			}
  			
  			$this->view->abstract = $id;
  			
  			$this->render();
    		$this->_helper->layout->disableLayout();
  		}
  	}
    
    
    public function noterAction(){
  
  		if($this->_hasParam('abstract') && $this->_hasParam('note'))
        {
        	$id = $this->_request->getParam('abstract'); 
        	$notation = $this->_request->getParam('note');
        	
        	$note = new Note();
        	$note->insertNote($id, $notation);

    		
  		}
  		$this->getHelper('viewRenderer')->setNoRender();
  	} 
    
    
    public function changelangAction(){

    	if($this->_hasParam('lang')){
    	
    		if($this->_hasParam('url')){
    			$url = $this->_request->getParam('url'); 
    		}else{
    			$url="/";
    		}
    		
        	$lang = $this->_request->getParam('lang'); 
    		Zend_Registry::get('session')->lang = $lang;
    		$this->_redirect(base64_decode($url));
    	}
    
    }
       
    public function postDispatch()
  	{

  	}

}