<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * NoteModel
 * @package Models
 */

class Note extends Zend_Db_Table {

  protected $_name = 'note';
  

	public function insertNote($id, $note)
    {
    	$this->insert(array('idAbstract'=>$id, 'dateAdd'=>time(), 'note'=>$note));
    }
       
    public function getNoteByIdAbstract($id) 
    {
    	$select = $this -> select() 
        		->from('note', array('AVG(note) AS avg', 'COUNT(idNote) as cpt'))
       			->where('idAbstract = ?', $id);
		
        $result = $this ->fetchRow($select);
        return $result;
    }

    public function getNote() 
    {
    	$select = $this -> select() 
        		->from('note', array('AVG(note) AS avg', 'idAbstract'))
        		->group(array('idAbstract'));
		
        $result = $this ->fetchAll($select);
   
       	$tab = array();
       	foreach($result as $res){
       		$tab[$res->idAbstract] = $res->avg;
       	}
        return $tab;
    }

}




