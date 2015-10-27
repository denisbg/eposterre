<?php
/**
 * ePoster v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2010
 * @version 1.0
 */

/**
 * AdminController
 * @package Controllers
 */
 
 
/*---Modèles----*/
require_once APPLICATION_PATH.'/application/models/Resume.php'; 
require_once APPLICATION_PATH.'/application/models/Profile.php'; 
require_once APPLICATION_PATH.'/application/models/Mail.php'; 
require_once APPLICATION_PATH.'/application/models/Note.php'; 

/*---Formulaire----*/ 
require_once APPLICATION_PATH.'/application/forms/Auth.php';
require_once APPLICATION_PATH.'/application/forms/ModifierAbstract.php';
require_once APPLICATION_PATH.'/application/forms/ValiderMail.php';


class AdminController extends Zend_Controller_Action {

    public function init()
  	{
		 $this->view->baseUrl = $this->_request->getBaseUrl();
		 $this->view->user = Zend_Auth::getInstance()->getIdentity(); //recupere l'identite de l'utilisateur
		 
		 $this->view->controller =  $this->_request->controller; 
		 $this->view->action =  $this->_request->action; 
    }


 	public function preDispatch()
  	{
		die("Accés non autorisé");
		//verifie si l'utilisateur est connecté
        if ($this->_request->action !='auth' && !Zend_Auth::getInstance()->hasIdentity()) { 
              //$this->_redirect('/admin/auth/');
        }
  	}
   
   
  
    
    
    function authAction()
    {
		
		$this->view->message = '';
            
        $form = new Form_Auth(array('action' => $this->view->url(array('action' => 'auth')),'method' => 'post'));
        $this->view->form = $form; // envoi du formulaire à la vue
 
        
        if ($this->_request->isPost()) //si formulaire envoyé
        {
			/*Recupération des valeurs du formulaire passée en POST*/
			$username = $this->_request->getPost('username');
			$password = $this->_request->getPost('password');

	
			if(!$form->isValid($_POST))
			{
				$this->view->message = "Nom d'utilisateur ou mot de passe incorrect";
			}
			else
			{
				
				$dbAdapter = Zend_Registry::get('dbAdapter'); //connecteur a la base de données
				$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter); //creation du Zend_Auth_Adapter_DbTable
				$authAdapter->setTableName('acces'); //definition de la table
				$authAdapter->setIdentityColumn('login'); //definition du champ qui contient le login
				$authAdapter->setCredentialColumn('pass'); //definition du champ qui contient le mot de passe
                               
				$authAdapter->setIdentity($username); // valeur de login
				$authAdapter->setCredential($password); //valeur du mot de passe
                $authAdapter->setCredentialTreatment('MD5(?)'); //type de hashage utilisé

				// authentification
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);

				if ($result->isValid()) // si authentification valide
				{
 					  /* Stocke les information de l'utilisateur sauf le mot de passe*/
                      $data = $authAdapter->getResultRowObject(null, 'pass');
                      $auth->getStorage()->write($data); // ajoute les informations dans l'espace de stockage par defaut de l'appli  
                      
                      $storage = new Zend_Auth_Storage_Session();
					  $sessionNamespace = new Zend_Session_Namespace($storage->getNamespace());
					  $sessionNamespace->setExpirationSeconds(7200); //expiration de la session 2h aprés la connexion de l'utilisateur
					  $auth->setStorage($storage);

					  $this->_redirect('/admin/index'); //redirection vers la page d'accueil
					
				} 
				else  // si echec d'authentification
				{
					$this->view->message = 'Nom d\'utilisateur ou mot de passe incorrect';
				
				}
			}
				
		}

        $this->render(); //appel la vue
    }
   
    
    function deconnexionAction()
    {
		 Zend_Auth::getInstance()->clearIdentity(); //supprime l'identité de l'utilisateur stockée		
		 $this->_redirect('/index/'); //redirection vers la page d'accueil

    }
    
    

    function indexAction()
    {

		$form = new Form_RechercheAdmin(array('action' => $this->view->url(array('action' => 'index')),'method' => 'POST'));
		$this->view->form = $form;
       
        $resume = new Resume();
       
  			if($this->_hasParam('choix') && $this->_hasParam('search') && !$this->_request->isPost()){
        		
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
        		
        	}elseif($this->_request->isPost()){

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
               		{
               		     
               			$this->_redirect('/index/slide/abstract/'.$abstract[0]->idAbstract);
               			
               		}
        		
        			$this->view->choix = false;

        	}
        	else
        	{
    			$this->view->resume = $resume->getAllAbstract(null);
        		$this->view->choix = false;
    		}
    		
    		$note = new Note();
			$this->view->note = $note->getNote();
	
			$this->render();

    }
    
    
    
   function modifierAction()
   {
   		if($this->_hasParam('abstract'))
        {
        	$id = $this->_request->getParam('abstract'); //recupère l'id de l'employé passer par l'url
        	
        	$resume = new Resume();
        	$res = $resume->getAbstractById($id);
        	$this->view->resume = $res;
        	
        	
        	$author = new Author();
        	$this->view->author = $author->getAuthorByIdAbstract($res[0]->idAbstract);

			$form = new Form_ModifierAbstract(array('action' => $this->view->url(array('action' => 'modifier')),'method' => 'POST'));
			$this->view->form = $form;
			
			
			if ($this->_request->isPost()) //si formulaire envoyer
        	{

					$moderate = $this->_request->getPost('moderate');
				
					$resume->updateAbstract($res[0]->idPoster, 0, $moderate);
			
					//récupération et sauvegarde de la video
            		$adapter = new Zend_File_Transfer_Adapter_Http();
					$adapter->setDestination('./public/abstracts/'.$res[0]->idPoster);
 			
            		if (!$adapter->receive()) 
            		{
   						$messages = $adapter->getMessages();
    					echo implode("\n", $messages);
					}
					else
					{     
						$name = $adapter->getFileName('movie'); //nom de la video
						
						$type = $adapter->getMimeType('movie'); //type mime
						$file = $res[0]->idPoster.'.wmv';

						$chemin = './public/abstracts/'.$res[0]->idPoster.'/'.$file; //chemin de sauvegarde

 						$filterFileRename = new Zend_Filter_File_Rename(array('target' => $chemin, 'overwrite' => true));
 						$filterFileRename -> filter($name);
						
						$resume->updateAbstract($res[0]->idPoster, 1, $moderate);
			
					}
				
				$this->_redirect('/admin/');
				
        	}
        	else
        	{
        		//$form->populate(array('moderate'=>$res[0]->moderateSession));
        	}
			
			
        	
        	$this->render();
        }
        else
        {
        	$this->_redirect('/admin/');
        }		
   }
      
      
      
   function supprimervideoAction()
   {
   		if($this->_hasParam('abstract'))
        {
        	$id = $this->_request->getParam('abstract'); //recupère l'id de l'employé passer par l'url
        	
        	$file = APPLICATION_PATH."/public/abstracts/".$id."/".$id.".wmv";
      
        	unlink($file);
        	
        	$resume = new Resume();
        	$resume->deleteVideo($id);   
  
        	$this->_redirect('/admin/');   
      	}
      	
   }
      
      
   function mailAction(){
   
   		$mail = new Mail();
   		$listeMail = $mail->getMails();
   
   		if ($this->_request->isPost()) //si formulaire envoyer
        {
      		$model =  file_get_contents('public/model.html');
   	
			foreach($listeMail as $email){
        	
        		$corps =utf8_decode($email->message);
        		$modelDest = str_replace('[MESSAGE]', $corps, $model);
        	
        		$mailSend = new Zend_Mail();
        		$mailSend->setBodyHtml($modelDest);
        		$mailSend->setFrom($email->email, utf8_decode($email->name));
        		$mailSend->addTo($email->login, utf8_decode($email->firstName).' '.utf8_decode($email->lastName));
        		$mailSend->setSubject(utf8_decode($email->title.' : '.$email->subject));
        		$mailSend->send(); //envoi du mail
        		
        		$mail->updateMail($email->idMail);
				
			}
		}else{
			$this->view->mail = $listeMail;
		
			$form = new Form_ValiderMail(array('action' => $this->view->url(array('action' => 'mail')),'method' => 'POST'));
			$this->view->form = $form;
		}
   
   		$this->render();
   
   }   
      
      
      
      
      
      
       
    public function postDispatch()
  	{

  	}

}