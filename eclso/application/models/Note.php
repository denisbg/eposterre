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
  

	public function insertNote($id, $note, $type)
    {
    	$this->insert(array('idAbstract'=>$id, 'type'=>$type, 'dateAdd'=>time(), 'note'=>$note));
    }
       
    public function getNoteByIdAbstract($id, $type) 
    {
    	$select = $this -> select() 
        		->from('note', array('AVG(note) AS avg', 'COUNT(idNote) as cpt'))
        		->where('type = ?', $type)
       			->where('idAbstract = ?', $id);
		
        $result = $this ->fetchRow($select);
        return $result;
    }

    public function getNote() 
    {
    	$select = $this -> select() 
        		->from('note', array('AVG(note) AS avg', 'type', 'idAbstract'))
        		->group(array('idAbstract', 'type'));
		
        $result = $this ->fetchAll($select);
   
       	$tab = array();
       	foreach($result as $res){
       		$tab[$res->idAbstract][$res->type] = $res->avg;
       	}
        return $tab;
    }

}




