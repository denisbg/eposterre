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

class Slide extends Zend_Db_Table {

  protected $_name = 'abstract-file';
  
    public function getAllSlides($idAbstract) 
    {
        $select = $this->select()
        		->from('abstract-file')
        		->join('abstract', 'abstract.idAbstract = abstract-file.idAbstract', array('idUser'))
        		->setIntegrityCheck(false)
        		->where('abstract.idAbstract = ?', $idAbstract)
        		->order('abstract-file.idFile ASC');
        		
		
        $result = $this ->fetchAll($select);
        return $result;
    }
    
}




