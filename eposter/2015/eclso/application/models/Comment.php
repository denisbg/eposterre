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
    
    
    public function getCommentsByIdPoster($id, $type) 
    {
    	$select = $this -> select() 
        		-> from('comment')
        		->where('idAbstract = ?', $id)
        		->where('type = ?', $type)
        		->where('isDeleted = 0')
        		->order('dateAdd ASC');
		
        $result = $this ->fetchAll($select);
        return $result;
    }
    
    public function getAllComments() {
	    $select = $this -> select() 
        		->from('comment')
        		->join('abstract', 'abstract.idAbstract = comment.idAbstract', array('idDefinitive', 'title'))
        		->setIntegrityCheck(false)
        		->where('isDeleted = 0')
        		->order('dateAdd DESC');
		
        $result = $this ->fetchAll($select);
        return $result;
    }

	public function insertComment($id, $name, $comment, $type)
    {
    	$this->insert(array('idAbstract'=>$id, 'type'=>$type, 'dateAdd'=>time(), 'name'=>$name, 'comment'=>$comment));
    }
       
	public function deleteComment($id)
    {
    	$this->update(array('isDeleted'=>1), 'idComment ='.$id);
    }

}




