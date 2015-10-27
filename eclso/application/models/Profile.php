<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * ProfileModel
 * @package Models
 */

class Profile extends Zend_Db_Table {

  protected $_name = 'profile';
  
   
    public function getProfile($id) 
    {
    	$select = $this -> select() 
        		-> from('profile')
        		->where('idUser = ?', $id);
		
        $result = $this ->fetchRow($select);
        return $result;
    }



}




