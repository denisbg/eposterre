<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * ImportedFileModel
 * @package Models
 */

class AbstractFile extends Zend_Db_Table {

  protected $_name = 'abstract-file';
  
    public function getAllSlides($idAbstract) 
    {
        $select = $this->select()
        		->from(array('af' => 'abstract-file'))
        		->join(array('a' => 'abstract'), 'a.idAbstract = af.idAbstract', array('idUser'))
        		->setIntegrityCheck(false)
        		->where('af.idAbstract = ? AND af.typeFile = "image" AND af.partAbstract = "convertedfile"', $idAbstract)
        		->order('af.idFile ASC');
		
        $result = $this ->fetchAll($select);
        return $result;
    }
    
    public function getAllSlidesAllAbstracts() 
    {
        $select = $this->select()
        		->from(array('af' => 'abstract-file'))
        		->join(array('a' => 'abstract'), 'a.idAbstract = af.idAbstract', array('idUser'))
        		->setIntegrityCheck(false)
        		->where('af.typeFile = "image" AND af.partAbstract = "convertedfile"')
        		->order('af.idFile ASC');
		
        $result = $this ->fetchAll($select);
        return $result;
    }
    
}




