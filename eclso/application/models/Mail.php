<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * MailModel
 * @package Models
 */

class Mail extends Zend_Db_Table {

  protected $_name = 'mail';
  
    
    
    public function getMails() 
    {
    	$select = $this -> select() 
        		->from('mail', array("idMail", "name", "message", "email AS mail", "subject"))
       			->join('abstract', 'abstract.idAbstract = mail.idAbstract', array('idDefinitive', 'idAbstract', 'idUser', 'title'))
       			->join('profile', 'profile.idUser = abstract.idUser', array('firstName', 'lastName', 'login'))
       			->where('etat = 0')
        		->setIntegrityCheck(false);
	
        $result = $this ->fetchAll($select);
        return $result;
    }

	public function insertMail($id, $name, $mail=null, $objet, $message)
    {
    	$this->insert(array('idAbstract'=>$id, 'dateAdd'=>time(), 'name'=>$name, 'email'=>$mail, 'subject'=>$objet, 'message'=>$message));
    }
       
	public function updateMail($id)
    {
    	$this->update(array('etat'=>1), 'idMail='.$id);
    }

}




