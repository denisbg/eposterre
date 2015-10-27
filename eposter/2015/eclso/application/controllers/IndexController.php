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
require_once APPLICATION_PATH.'/application/forms/RechercheRapide.php'; 
require_once APPLICATION_PATH.'/application/forms/Commenter.php';  
require_once APPLICATION_PATH.'/application/forms/Mailer.php'; 


class IndexController extends Zend_Controller_Action {


    public function init()
  	{
		 $this->view->baseUrl = $this->_request->getBaseUrl();
		 $this->view->user = Zend_Auth::getInstance()->getIdentity(); //recupere l'identite de l'utilisateur
		 
		 
		// $this->view->translate = Zend_Registry::get('translate');
		 
		 $this->view->controller =  $this->_request->controller; 
		 $this->view->action =  $this->_request->action; 
		
    }


 	public function preDispatch()
  	{
  		/*if(!Zend_Auth::getInstance()->hasIdentity()){
  			$this->_redirect('/auth/index');
  		}*/
  	}
  	
  	function montestAction(){
            $abstarctFile = new AbstractFile();
            $listeAF = $abstarctFile->getAllSlidesAllAbstracts();
            
            foreach($listeAF as $LAF){
                $file = 'public/abstracts/'.$LAF['idUser'].'/'.$LAF['pathFile'];
               // echo $file."<br />";
                if(!file_exists($file)){
                    echo $LAF['idFile']."<br />";
                }    
            }
            
            var_dump($listeAF);
	  	die('mon test');
  	}
   
   
    function indexAction()
    {
		$form = new Form_Recherche_Rapide(array('action' => $this->view->url(array('action' => 'listecomplete')),'method' => 'POST'));
		$this->view->form = $form;
  
		$this->render();
    }
    
    
    
    
  /* Creation du repertoire pour chaque abstract + fichier parameters.xml */
  	function createdirectoryAction()
    {

		$resume = new Resume();
        $result = $resume->getAbstractDirectory();
     
       // $this->view->resume = $result;
        
       // $notif ='<![CDATA[http://dev.europa-organisation.com/eposter/test.php?transaction=##TransactionId##&result=##ResultValue##&slides=##Slides##&videos=##Videos##&processtime=##ProcessTime##]]>';
        
        foreach($result as $abstract)
        {
        	
        	$rep = APPLICATION_PATH."/public/abstracts/".$abstract->idAbstract;
        	
        	mkdir($rep, 0777);

        	/*$dom = new DomDocument();

        	$parametre = $dom->createElement("parameters");
        	$transaction = $dom->createElement("transaction", $abstract->idPoster);
        	$notification = $dom->createElement("notification", htmlentities($notif));
        	$name = $dom->createElement("name", $abstract->file);
        	$prefix = $dom->createElement("prefix", "img");
        	$extension = $dom->createElement("extension", "png");
        	$size = $dom->createElement("size", "800x600");

        	$dom->appendChild($parametre);
        	$parametre->appendChild($transaction);
        	$parametre->appendChild($notification);
        	$parametre->appendChild($name);
        	$parametre->appendChild($prefix);
        	$parametre->appendChild($extension);
        	$parametre->appendChild($size);
        	
			$dom->save($rep.'/parameters.xml');*/
			
    
        	$repResume = Zend_Registry::get('config')->resume->name;
        	
        
        	
        	copy('http://resumes.europa-organisation.com/_global/files/'.$repResume.'/'.$abstract->idUser.'/'.$abstract->pathFile, APPLICATION_PATH.'/public/abstracts/'.$abstract->idAbstract.'/'.$abstract->pathFile); //copie du ppt
        	
        	$this ->_helper ->viewRenderer ->setNoRender () ;
        	
        }
		
    }
    
    
    //fonction de recherche
    function searchAction(){
  		if($this->_request->isPost()){
        	$search = $this->_request->getPost('search');
        	$choice = $this->_request->getPost('choice');
        	$this->view->admin = $this->_request->getPost('admin');

			$resume = new Resume();
       		$this->view->resume = $resume->getAllAbstract(addslashes($search),$choice);
       		
    		$this->_helper->layout->disableLayout();
        	$this->view->search = $search;
        			
			$this->render();
		}
    }
    
    /*function searchcategoryAction(){
    	if($this->_request->isPost()){
    		$choice = $this->_request->getPost('choice');
    		
    		$resume = new Resume();
    		
    		$this->view->resume = $resume->getAllAbstract(null,$choice);
    		
    		$note = new Note();
			$this->view->note = $note->getNote();
			
			$this->_helper->layout->disableLayout();
    		$this->render();
    	}
    }*/
    
    //affiche la liste de tous les abstracts
    function listecompleteAction(){
    	// Si on fait une recherche par catégorie
	    if($this->_request->isPost() && $this->_request->getPost('choice')) {
	    
	    	$choice = $this->_request->getPost('choice');
    		
    		$resume = new Resume();
    		
    		$this->view->resume = $resume->getAllAbstract(null,$choice);
    		//sort($this->view->resume);
    		$this->view->choix = false;
    		$this->view->formatPage = false;

			$this->_helper->layout->disableLayout();
	    
	    } else {
			$form = new Form_Recherche(array('action' => $this->view->url(array('action' => 'listecomplete')),'method' => 'POST'));
			$this->view->form = $form;
	       
	        $resume = new Resume();
	       
	  			if($this->_hasParam('choix') && $this->_hasParam('search') && !$this->_request->isPost()) {
	        		$choix = $this->_request->getParam('choix');
	        		$search = $this->_request->getParam('search');
	      		
	       			if($choix == 0){
	       				$this->view->resume = $resume->getAllAbstract($search);
	       			}
	       			elseif($choix == 1 || $choix == 2){
	       				$this->view->resume = $resume->getAllAbstractChoice($choix, $search);
	       			}
	       			elseif($choix==3){
	       				$this->view->resume = $resume->getAllAbstractModerate($search);
	       			}
	       			elseif($choix == 4){
	       				$this->view->resume = $resume->getAllAbstractViewed($search);
	       			}
	       			elseif($choix == 5){
	       				$this->view->resume = $resume->getAllAbstractNote($search);
	       			}
	       	
	    			$this->_helper->layout->disableLayout();
	        		$this->view->choix = true;
	        	} elseif($this->_request->isPost()){
	                $search = $this->_request->getParam('search');
	               	$abstract = $resume->getAllAbstract($search);
	               		
	               	if(count($abstract)>1){
	               		$this->view->resume = $abstract;
	               		$form->populate(array('search'=>$search));
	               	}
	               	elseif(count($abstract)==0)
	               	{
	               		$this->view->resume = $resume->getAllAbstract(null);
				   	}
	               	else
	               		$this->_redirect('/index/slide/abstract/'.$abstract[0]->idAbstract);
	        		
				   	$this->view->choix = true;
	        		$this->_helper->layout->disableLayout();
	        	}
	        	else
	        	{ 
	    			$this->view->resume = $resume->getAllAbstract(null);
	        		$this->view->choix = false;
	    		}
	    }

		$note = new Note();
		$this->view->note = $note->getNote();
		
		$this->render();

    }
    
    
    
    function slideAction(){
    	$this->view->resume = false;
    	
        if($this->_hasParam('abstract')){
        	$id = $this->_request->getParam('abstract'); 
        	$this->view->idSlide = $id;

			$cf = new Config();
			$config = $cf->getConfig();
			
			$this->view->countdownShow = Zend_Registry::get('config')->option->countdownShow;
						
        	$view = new View();
        	$view->updateViewSlideAbstract($id);

        	$resume = new Resume();
        	$res = $resume->getAbstractById($id); 
        	if ($res[0]) { 
	        	$this->view->resume = $res;
	
	        	$author = new Author();
	        	$this->view->author = $author->getAuthorByIdAbstract($res[0]->idAbstract);
	
	        	$slide = new AbstractFile();
	        	$this->view->slides = $slide->getAllSlides($res[0]->idAbstract);
	
				/*$tab = array();
				$contenuRep = array_slice(scandir(APPLICATION_PATH.'/public/abstracts/'.$id), 2); //liste le contenu du repertoire
				foreach($contenuRep as $file)
				{
					$ext = strtolower(substr($file, strrpos($file, '.')));
					if($ext == '.png'|| $ext == '.jpg'|| $ext == '.jpeg'|| $ext == '.gif')
					{
						array_push($tab, $file);
					}
				}*/
				
				/*if(Zend_Registry::get('config')->option->commenter == true || Zend_Registry::get('config')->option->mail == true || Zend_Registry::get('config')->option->notation == true){
					array_push($tab, 'options');
				}*/
				
				if(Zend_Registry::get('config')->option->notation == true){
					$note = new Note();
					$avg = $note->getNoteByIdAbstract($id, 'slide');
					$this->view->note = $avg->cpt;
					$note = $avg->avg*135/5;
				
					$this->view->headScript()->prependScript('$(document).ready(function(){addNote("'.$this->_request->getBaseUrl().'", '.$res[0]->idAbstract.', "slide"); return false;})');
					//$this->view->headScript()->prependScript('$(document).ready(function(){$("#fake-stars-on").width('.$note.')})');
				}
	
				$this->view->vue = $res[0]->viewSlide;
				//$this->view->tab = $tab;
	
			/*	$full = $this->_request->getParam('full');
	
				if($full == true){
					$diapo = $this->_request->getParam('diapo');
					$this->view->diapo = $diapo;
					$this->view->fullScreen = true;
	    			$this->_helper->layout->disableLayout();
				}else{
					$this->view->diapo = 1;
					$this->view->firstDiapo = $tab[0];
					$this->view->fullScreen = false;
				}*/
				$this->render();
			}
        }
        else
         	$this->_redirect('/index/listecomplete');     				
    }
    
    
    function videoAction()
    {
		
        if($this->_hasParam('abstract'))
        {
        	$id = $this->_request->getParam('abstract'); 
        	
        	$resume = new Resume();
        	$view = new View();
        	
        	$view->updateViewVideoAbstract($id);
        	
        	$res = $resume->getAbstractById($id);
        	$this->view->resume = $res;
        	
        	$author = new Author();
        	$this->view->author = $author->getAuthorByIdAbstract($res[0]->idAbstract);

			
  			 
  			if(Zend_Registry::get('config')->option->notation == true){
				$note = new Note();
				$avg = $note->getNoteByIdAbstract($id, 'video');
				$this->view->note = $avg->cpt;
				$note = $avg->avg*135/5;
			
				$this->view->headScript()->prependScript('$(document).ready(function(){addNote("'.$this->_request->getBaseUrl().'", '.$res[0]->idAbstract.', "video"); return false;})');
	
			}
	
			$this->view->vue = $res[0]->viewVideo;

			$this->render();
        }
        else
        {
        	$this->_redirect('/index/listecomplete');
        } 
		
    }
    
    
    public function showoptionAction(){
    	
    	if($this->_hasParam('abstract'))
        {
        	$id = $this->_request->getParam('abstract'); 
        	$this->view->type = $this->_request->getParam('type');
	
			$this->view->abstract = $id; 
	
    		$this->render();
    		$this->_helper->layout->disableLayout();
    	}
    }
    
    
    public function commenterAction(){
  
  		if($this->_hasParam('abstract') && $this->_hasParam('type')){
        	$id = $this->_request->getParam('abstract'); 
        	$type = $this->_request->getParam('type');

			$comment = new Comment();

  			if($this->_request->isPost()){
  			
  				$commentaire = $this->_request->getPost('comment');
  				$nom = $this->_request->getPost('name');
  				
  				
  				$comment->insertComment($id, $nom, $commentaire, $type);
  			
  				$this->view->form = $this->view->translate('Commentaire ajouté');
  				
  			}else{
  				$form = new Form_Commenter(array('action' => $this->view->url(array('action' => 'commenter')),'method' => 'POST'), $id, $type, $this->_request->getBaseUrl());
				$this->view->form = $form;
  			}
  			
  			$this->view->comment = $comment->getCommentsByIdPoster($id, $type);
  			
  			$this->view->abstract = $id;
  			$this->view->type = $type;
  			
  			$this->render();
    		$this->_helper->layout->disableLayout();
  		}
  	}	
    
    
    public function mailerAction(){
  
  		if($this->_hasParam('abstract') && $this->_hasParam('type'))
        {
        	$id = $this->_request->getParam('abstract'); 
        	$type = $this->_request->getParam('type');

  			if($this->_request->isPost()){
  			
  				$message = $this->_request->getPost('message');
  				$nom = $this->_request->getPost('name');
  				$mail = $this->_request->getPost('mail');
  				$objet = $this->_request->getPost('subject');
  				
  				$comment = new Mail();
  				$comment->insertMail($id, $nom, $mail, $objet, $message);
  				
  				//$this->view->form = $this->view->translate('Email envoyé');
  				
  				
  			}else{
  				$form = new Form_Mailer(array('action' => $this->view->url(array('action' => 'mailer')),'method' => 'POST'), $id, $type, $this->_request->getBaseUrl());
				$this->view->form = $form;
  			}
  			
  			$this->view->abstract = $id;
  			$this->view->type = $type;
  			
  			$this->render();
    		$this->_helper->layout->disableLayout();
  		}
  	}
    
    
    public function noterAction(){
  
  		if($this->_hasParam('abstract') && $this->_hasParam('note'))
        {
        	$id = $this->_request->getParam('abstract'); 
        	$notation = $this->_request->getParam('note');
        	$type = $this->_request->getParam('type');
        	
        	$note = new Note();
        	$note->insertNote($id, $notation, $type);

    		
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
     
    function checkvideoAction(){ 
        if($this->_hasParam('slide') && $this->_hasParam('abstract') && $this->_hasParam('width') && $this->_hasParam('height')){
        	$slide = $this->_request->getParam('slide');
        	$abstract = $this->_request->getParam('abstract');
        	$this->view->height = $this->_request->getParam('height');
        	$this->view->width = $this->_request->getParam('width');
        	
        	/*Récupère le numéro de l'image*/
        	$img = strrchr($slide, '/');
        	$slide = substr($img, 1);
  
        	/*Récupère les videos de la slide*/
        	$media = new Media();
        	$videos = $media->getAllVideo($abstract, $slide);
        	
        	
        	$this->view->videos = $videos;
        	        	
    		$this->_helper->layout->disableLayout();
    		$this->render();
        	
        }  
    }
       
    public function postDispatch()
  	{

  	}

}