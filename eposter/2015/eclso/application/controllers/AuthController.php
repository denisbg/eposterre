<?php
/**
 * ePoster v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2010
 * @version 1.0
 */

/**
 * AuthController
 * @package Controllers
 */
 

/*---Formulaire----*/ 
 
require_once APPLICATION_PATH.'/application/forms/Pass.php'; 


class AuthController extends Zend_Controller_Action {


    public function init()
  	{
		 $this->view->baseUrl = $this->_request->getBaseUrl();
		 $this->view->user = Zend_Auth::getInstance()->getIdentity(); //recupere l'identite de l'utilisateur

		 $this->view->controller =  $this->_request->controller; 
		 $this->view->action =  $this->_request->action;
    }


 	public function preDispatch()
  	{


  	
  	}
   
   
    function indexAction()
    {
		$form = new Form_Pass(array('action' => $this->view->url(array('action' => 'index')),'method' => 'POST'));
		$this->view->form = $form;
  		
  		if ($this->_request->isPost()) //si formulaire envoyer
        {
			/*Recupération des valeurs du formulaire passée en POST*/
			$password = $this->_request->getPost('code');

			$auth = Zend_Auth::getInstance();
			if ($password == Zend_Registry::get('config')->code->password) // si authentification valide
			{   
               	$auth->getStorage()->write(array("connect"=>true));
               
				Zend_Session::rememberMe(7200);
				
				$this->_redirect('/index/listecomplete'); //redirection vers la page d'accueil
					
			}else{
				$this->view->message = $this->view->translate('Code incorrect');
			}
			
		}
		$this->render();
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
    
    
  }