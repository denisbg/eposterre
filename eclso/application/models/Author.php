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

class Author extends Zend_Db_Table {

  protected $_name = 'author';
  

    public function getAuthorByIdAbstract($id) 
    {
    	$select = $this -> select() 
        		-> from('author')
        		->where('idAbstract = ?', $id)
        		->order('order ASC');
		
        $result = $this ->fetchAll($select);
        return $result;
    }


}




