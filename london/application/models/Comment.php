<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * CommentModel
 * @package Models
 */

class Comment extends Zend_Db_Table {

  protected $_name = 'comment';
  
    
    
    public function getCommentsByIdPoster($id) 
    {
    	$select = $this -> select() 
        		-> from('comment')
        		->where('idAbstract = ?', $id)
        		->order('dateAdd ASC');
		
        $result = $this ->fetchAll($select);
        return $result;
    }

	public function insertComment($id, $name, $comment)
    {
    	$this->insert(array('idAbstract'=>$id, 'dateAdd'=>time(), 'name'=>$name, 'comment'=>$comment));
    }
       


}




