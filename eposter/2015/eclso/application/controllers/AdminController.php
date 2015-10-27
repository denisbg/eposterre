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
require_once APPLICATION_PATH.'/application/models/Author.php'; 
require_once APPLICATION_PATH.'/application/models/Mail.php'; 
require_once APPLICATION_PATH.'/application/models/Note.php'; 
require_once APPLICATION_PATH.'/application/models/Comment.php'; 

/*---Formulaire----*/ 
require_once APPLICATION_PATH.'/application/forms/Auth.php';
require_once APPLICATION_PATH.'/application/forms/ModifierAbstract.php';
require_once APPLICATION_PATH.'/application/forms/RechercheAdmin.php';
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
		//$this->_redirect('/index/listecomplete');
		//verifie si l'utilisateur est connecté
        if ($this->_request->action !='auth' && !Zend_Auth::getInstance()->hasIdentity()) { 
              $this->_redirect('/admin/auth/');
        }
  	}
    
    function authAction()
    {
		
		$this->view->message = '';
            
        $form = new Form_Auth(array('action' => $this->view->url(array('action' => 'auth')),'method' => 'post'));
        $this->view->form = $form; // envoi du formulaire à la vue
        
        
        if ($this->_request->isPost()) //si formulaire envoyer
        {
			/*Recupération des valeurs du formulaire passée en POST*/
			$username =$this->_request->getPost('username');
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
        $resume = new Resume();
        $search = NULL;
       	$this->view->resume = $resume->getAllAbstract($search, null, 1);

    	$note = new Note();
		$this->view->note = $note->getNote();

		$this->render();
    }
    

   function supprimerabstractAction(){
	   	if($this->_hasParam('abstract')){
		    $id = $this->_request->getParam('abstract'); //recupère l'id de l'employé passer par l'url
        	$resume = new Resume();
			$resume->deleteAbstract($id);
			$this->_redirect('admin/index');
		}
   }
   
   function supprimercommentAction(){
	   	if($this->_hasParam('abstract')){
		    $idA = $this->_request->getParam('abstract'); //recupère l'id
		    $idC = $this->_request->getParam('comment'); //recupère l'id
        	$comment = new Comment();
			$comment->deleteComment($idC);
			$url = 'admin/modifier/abstract/'.$idA;
			$this->_redirect($url);
		}
   }

    
   function activerabstractAction(){
	   	if($this->_hasParam('abstract')){
		    $id = $this->_request->getParam('abstract'); //recupère l'id de l'employé passer par l'url
        	$resume = new Resume();
			$resume->activeAbstract($id);
			$this->_redirect('admin/index');
		}
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
			
			$comments = new Comment();
			$this->view->commentSlide = $comments->getCommentsByIdPoster($res[0]->idAbstract, 'slide');
			$this->view->commentVideo = $comments->getCommentsByIdPoster($res[0]->idAbstract, 'video');
			
			if ($this->_request->isPost()) //si formulaire envoyer
        	{

					$moderate = $this->_request->getPost('moderate');
				
					$resume->updateAbstract($res[0]->idPoster, 0, $moderate);
			
					//récupération et sauvegarde de la video
            		$adapter = new Zend_File_Transfer_Adapter_Http();
					//$adapter->setDestination('./public/abstracts/'.$res[0]->idPoster);
					$adapter->setDestination('./public/abstracts/'.$res[0]->idAbstract);
 			
            		if (!$adapter->receive()) 
            		{
   						$messages = $adapter->getMessages();
    					echo implode("\n", $messages);
					}
					else
					{     
						$name = $adapter->getFileName('movie'); //nom de la video
						
						$type = $adapter->getMimeType('movie'); //type mime
						$file = $res[0]->idAbstract.'.wmv';

						$chemin = './public/abstracts/'.$res[0]->idAbstract.'/'.$file; //chemin de sauvegarde

 						$filterFileRename = new Zend_Filter_File_Rename(array('target' => $chemin, 'overwrite' => true));
 						$filterFileRename -> filter($name);
						
						$resume->updateAbstract($res[0]->idAbstract, 1, $moderate);
			
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
   
   function commentAction() {
	   $comment = new Comment();
	   $listeComment = $comment->getAllComments();
	   
	   $this->view->comment = $listeComment;
	   $this->render();
   }  
      
   function mailAction(){
   
	    $mail = new Mail();
   		$listeMail = $mail->getMails();
   
   		$form = new Form_ValiderMail(array('action' => $this->view->url(array('action' => 'mail')),'method' => 'POST'));
   		$this->view->form = $form;
   
   		if ($this->_request->isPost()) //si formulaire envoyer
        {
      		$model =  file_get_contents('public/model.html');
      		$datas = $this->getRequest()->getPost();
  
			foreach($listeMail as $email){
        	    if(array_key_exists($email->idMail, $datas)){
            		$corps = "You received a message about your ePoster ".$email->idDefinitive." - ".$email->title.".<br/><br/><strong>Name:</strong> ".$email->name."<br/><strong>Email:</strong> ".$email->mail."<br/><strong>Subject:</strong> ".$email->subject."<br/><strong>Message:</strong> ".utf8_decode($email->message);
            		$modelDest = str_replace('[MESSAGE]', $corps, $model);
            	
            	$config = array('port' => 25, 'ssl'=>'tls');
            	$transport = new Zend_Mail_Transport_Smtp('192.168.7.254', $config); //serveur smtp du centre des congrès
            	
            		$mailSend = new Zend_Mail();
            		$mailSend->setBodyHtml($modelDest);
            		if(Zend_Registry::get('config')->option->mailTest == true){
            		    $mailSend->setFrom($email->mail, utf8_decode($email->name));
                		$mailSend->addTo("".Zend_Registry::get('config')->option->mailAddressTest."", "");
            		}else{ 
                		$mailSend->setFrom($email->mail, utf8_decode($email->name));
                		$mailSend->addTo($email->login, "");
            		}

            		$mailSend->setSubject("".Zend_Registry::get('config')->resume->name." : a message about your e-Poster");
            		$mailSend->send($transport); //envoi du mail
            		
            		$mail->updateMail($email->idMail);
            		
        		}
			}
			
	   		$listeMail = $mail->getMails();
	   		
	   		$this->view->mail = $listeMail;
			$this->view->send = true;
		}else{
			$this->view->mail = $listeMail;
		
		}
   
   		$this->render();
   
   }   
      
      
      
      
      
      
       
    public function postDispatch()
  	{

  	}

}