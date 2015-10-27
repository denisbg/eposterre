<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * CongresModel
 * @package Models
 */

class Congres extends Zend_Db_Table {

  protected $_name = 'congres';
  
  
    public function getInfoCongres() 
    {
    	$select = $this -> select() 
        		-> from('congres');

        $result = $this ->fetchRow($select);
        return $result;
    }

}




