<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * AuthorModel
 * @package Models
 */

class Category extends Zend_Db_Table {

  protected $_name = 'category';
  

    public function getOnlineCategory() 
    {
    	$select = $this -> select() 
        		->from('category')
        		->where('online = 1')
        		->where('deleted = 0')
        		->order("name");
		
        $result = $this ->fetchAll($select);
        return $result;
    }


}




